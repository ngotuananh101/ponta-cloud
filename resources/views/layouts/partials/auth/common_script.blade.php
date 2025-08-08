<script>
    const form = document.getElementById('auth_form');
    const submitButton = form.querySelector('button[type="submit"]');
    form.addEventListener('submit', function (e) {
        // Disable the submit button to prevent multiple clicks
        submitButton.disabled = true;
        // Show a toast notification
        KTToast.show({
            message: '{{ __('Please wait a moment...') }}',
            variant: 'info',
            progress: true,
            duration: 3000,
        });
    });

    @if (session('success'))
    KTToast.show({
        message: '{{ session('success') }}',
        variant: 'success',
        progress: true,
        duration: 3000,
    });
    @endif
</script>
