<?php

namespace Database\Seeders;

use App\Enums\CloudType;
use App\Models\Cloud;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ngo Tuan Anh',
            'email' => 'ngotuananh2101@gmail.com',
        ]);

        Cloud::create([
            'user_id' => 1,
            'type' => CloudType::OD,
            'display_name' => 'OneDrive',
            'data' => json_encode([
                'client_id' => env('ONEDRIVE_CLIENT_ID', 'your-client-id'),
                'client_secret' => env('ONEDRIVE_CLIENT_SECRET', 'your-client-secret'),
                'redirect_uri' => env('ONEDRIVE_REDIRECT_URI', 'https://ponta-cloud.ponta.lc/onedrive/1/callback'),
                'tenant_id' => env('ONEDRIVE_TENANT_ID', 'your-tenant-id'),
            ]),
        ])->save();
    }
}
