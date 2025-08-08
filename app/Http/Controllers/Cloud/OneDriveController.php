<?php

namespace App\Http\Controllers\Cloud;

use App\Http\Controllers\Controller;
use App\Models\Cloud;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OneDriveController extends Controller
{
    private const SCOPES = 'offline_access User.Read Files.ReadWrite.All';
    private const SESSION_STATE_KEY = 'oauth_%s_state';

    /**
     * Redirect user to Microsoft OAuth authorization page
     *
     * @param string $cloudId
     * @return RedirectResponse
     * @throws RandomException|Exception
     */
    public function redirectToProvider(string $cloudId): RedirectResponse
    {
        $cloud = $this->getCloudWithValidation($cloudId);
        $cloudData = $this->getCloudData($cloud);

        // Generate secure state parameter
        $state = bin2hex(random_bytes(32));
        session([sprintf(self::SESSION_STATE_KEY, $cloudId) => $state]);

        // Build authorization URL
        $authorizationUrl = $this->buildAuthorizationUrl($cloudData, $state);

        return redirect($authorizationUrl);
    }

    /**
     * Handle OAuth callback and exchange code for tokens
     *
     * @param Request $request
     * @param string $cloudId
     * @return RedirectResponse
     */
    public function handleCallback(Request $request, string $cloudId): RedirectResponse
    {
        $backUrl = route('home');

        try {
            $cloud = $this->getCloudWithValidation($cloudId);
            $cloudData = $this->getCloudData($cloud);

            // Verify state to prevent CSRF
            $this->verifyState($request, $cloudId);

            // Check for OAuth errors
            $this->checkOAuthErrors($request);

            // Get authorization code
            $authorizationCode = $this->getAuthorizationCode($request);

            // Exchange code for tokens
            $tokenData = $this->exchangeCodeForTokens($cloudData, $authorizationCode);

            // Update cloud with tokens
            $this->updateCloudTokens($cloud, $cloudData, $tokenData);

            // Clean up session
            $this->clearSessionState($cloudId);

            // Test connection
            $userInfo = $this->testConnection($cloudId);

            return redirect($backUrl)->with('success', "OneDrive connected successfully! Welcome, {$userInfo['displayName']}!");
        } catch (Exception $e) {
            $this->clearSessionState($cloudId);
            return redirect($backUrl)->withErrors(['error' => 'Failed to connect OneDrive: ' . $e->getMessage()]);
        }
    }

    /**
     * Test the OneDrive connection by fetching user profile
     *
     * @param string $cloudId
     * @return array
     * @throws Exception
     */
    private function testConnection(string $cloudId): array
    {
        $cloud = $this->getCloudWithValidation($cloudId);
        $cloudData = $this->getCloudData($cloud);

        if (!isset($cloudData['access_token'])) {
            throw new Exception('No access token available');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cloudData['access_token'],
                'Accept' => 'application/json',
            ])->get('https://graph.microsoft.com/v1.0/me');

            if ($response->failed()) {
                throw new Exception('Failed to fetch user profile: ' . $response->body());
            }

            $userData = $response->json();

            return [
                'id' => $userData['id'] ?? null,
                'displayName' => $userData['displayName'] ?? 'Unknown User',
                'mail' => $userData['mail'] ?? $userData['userPrincipalName'] ?? null,
                'userPrincipalName' => $userData['userPrincipalName'] ?? null,
            ];
        } catch (Exception $e) {
            throw new Exception('Connection test failed: ' . $e->getMessage());
        }
    }

    // === Helper Methods ===

    /**
     * Get cloud model with validation
     */
    private function getCloudWithValidation(string $cloudId): Cloud
    {
        return Cloud::findOrFail($cloudId);
    }

    /**
     * Get and validate cloud data
     * @throws Exception
     */
    private function getCloudData(Cloud $cloud): array
    {
        $cloudData = $cloud->data;

        if (!$cloudData || !isset($cloudData['client_id'], $cloudData['client_secret'], $cloudData['redirect_uri'])) {
            throw new Exception('Missing required OAuth configuration in cloud data');
        }

        return $cloudData;
    }

    /**
     * Build authorization URL for Microsoft OAuth
     */
    private function buildAuthorizationUrl(array $cloudData, string $state): string
    {
        $tenant = $cloudData['tenant_id'] ?? 'common';
        $baseUrl = "https://login.microsoftonline.com/{$tenant}/oauth2/v2.0/authorize";

        $params = http_build_query([
            'client_id' => $cloudData['client_id'],
            'response_type' => 'code',
            'redirect_uri' => $cloudData['redirect_uri'],
            'scope' => self::SCOPES,
            'state' => $state,
            'response_mode' => 'query',
        ]);

        return $baseUrl . '?' . $params;
    }

    /**
     * Verify CSRF state parameter
     */
    private function verifyState(Request $request, string $cloudId): void
    {
        $receivedState = $request->get('state');
        $sessionState = session(sprintf(self::SESSION_STATE_KEY, $cloudId));

        if (!$receivedState || $receivedState !== $sessionState) {
            throw new Exception('Invalid state parameter. Possible CSRF attack.');
        }
    }

    /**
     * Check for OAuth authorization errors
     */
    private function checkOAuthErrors(Request $request): void
    {
        if ($request->has('error')) {
            $error = $request->get('error');
            $description = $request->get('error_description', 'Unknown error');
            throw new Exception("OAuth authorization failed: {$error} - {$description}");
        }
    }

    /**
     * Get and validate authorization code
     */
    private function getAuthorizationCode(Request $request): string
    {
        $code = $request->get('code');

        if (!$code) {
            throw new Exception('Authorization code not received');
        }

        return $code;
    }

    /**
     * Exchange authorization code for access tokens using HTTP request
     */
    private function exchangeCodeForTokens(array $cloudData, string $authorizationCode): array
    {
        $tenant = $cloudData['tenant_id'] ?? 'common';
        $tokenUrl = "https://login.microsoftonline.com/{$tenant}/oauth2/v2.0/token";

        try {
            $response = Http::asForm()->post($tokenUrl, [
                'client_id' => $cloudData['client_id'],
                'client_secret' => $cloudData['client_secret'],
                'grant_type' => 'authorization_code',
                'code' => $authorizationCode,
                'redirect_uri' => $cloudData['redirect_uri'],
                'scope' => self::SCOPES,
            ]);

            if ($response->failed()) {
                throw new Exception('HTTP request failed: ' . $response->body());
            }

            $data = $response->json();

            if (isset($data['error'])) {
                throw new Exception("OAuth error: {$data['error']} - {$data['error_description']}");
            }

            return [
                'access_token' => $data['access_token'],
                'refresh_token' => $data['refresh_token'] ?? null,
                'expires_at' => isset($data['expires_in']) ? time() + $data['expires_in'] : null,
                'token_type' => $data['token_type'] ?? 'Bearer',
            ];
        } catch (Exception $e) {
            throw new Exception('Failed to exchange authorization code: ' . $e->getMessage());
        }
    }

    /**
     * Update cloud model with token data
     */
    private function updateCloudTokens(Cloud $cloud, array $cloudData, array $tokenData): void
    {
        $updatedData = array_merge($cloudData, $tokenData);
        $cloud->update(['data' => json_encode($updatedData)]);
    }

    /**
     * Clear OAuth session state
     */
    private function clearSessionState(string $cloudId): void
    {
        session()->forget(sprintf(self::SESSION_STATE_KEY, $cloudId));
    }

    /**
     * List folders and files by path
     *
     * @param string $cloudId
     * @param string $path Path relative to root (starting with / or empty for root)
     * @return array
     * @throws Exception
     */
    public function listByPath(string $cloudId, string $path = ''): array
    {
        $cloud = $this->getCloudWithValidation($cloudId);
        $cloudData = $this->getCloudData($cloud);

        if (!isset($cloudData['access_token'])) {
            throw new Exception('No access token available');
        }

        try {
            // Prepare the API endpoint
            $endpoint = $this->buildListEndpoint($path);

            // Make the request to Microsoft Graph API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $cloudData['access_token'],
                'Accept' => 'application/json',
            ])->get($endpoint);

            if ($response->failed()) {
                throw new Exception('Failed to list files: ' . $response->body());
            }

            $data = $response->json();

            // Process and format the response
            return $this->formatListResponse($data, $path);
        } catch (Exception $e) {
            throw new Exception('Failed to list files and folders: ' . $e->getMessage());
        }
    }

    /**
     * Build the Microsoft Graph API endpoint for listing files
     */
    private function buildListEndpoint(string $path): string
    {
        $baseUrl = 'https://graph.microsoft.com/v1.0/me/drive';

        // Clean and normalize the path
        $path = trim($path, '/');

        if (empty($path)) {
            // List root folder
            return $baseUrl . '/root/children?$select=id,name,size,lastModifiedDateTime,folder,file,createdBy&$expand=createdBy($select=user)';
        } else {
            // List specific folder by path
            return $baseUrl . '/root:/' . urlencode($path) . ':/children?$select=id,name,size,lastModifiedDateTime,folder,file,createdBy&$expand=createdBy($select=user)';
        }
    }

    /**
     * Format the Microsoft Graph API response
     */
    private function formatListResponse(array $data, string $requestPath): array
    {
        $items = [];

        if (!isset($data['value'])) {
            return $items;
        }

        // Clean and normalize the request path
        $requestPath = trim($requestPath, '/');
        $basePath = empty($requestPath) ? '' : '/' . $requestPath;

        foreach ($data['value'] as $item) {
            $isFolder = isset($item['folder']);
            $itemPath = $basePath . '/' . $item['name'];

            // Get owner information
            $owner = 'Unknown';
            if (isset($item['createdBy']['user']['displayName'])) {
                $owner = $item['createdBy']['user']['displayName'];
            } elseif (isset($item['createdBy']['user']['email'])) {
                $owner = $item['createdBy']['user']['email'];
            }

            $items[] = [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? 'Unknown',
                'owner' => $owner,
                'size' => $isFolder ? null : ($item['size'] ?? 0),
                'path' => $itemPath,
                'last_modified' => isset($item['lastModifiedDateTime'])
                    ? date('Y-m-d H:i:s', strtotime($item['lastModifiedDateTime']))
                    : null,
                'type' => $isFolder ? 'folder' : 'file',
                'is_folder' => $isFolder
            ];
        }

        return $items;
    }
}
