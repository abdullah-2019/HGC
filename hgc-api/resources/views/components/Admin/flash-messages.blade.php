<div class="fixed top-5 right-5 z-50 space-y-2 w-full max-w-sm">
    @php
        $statusMessages = [
            'profile-updated' => 'Profile updated successfully.',
            'password-updated' => 'Password updated successfully.',
            'verification-link-sent' => 'A new verification link has been sent to your email address.',
        ];
    @endphp

    @if(session('success'))
        <x-admin.alert type="success" :message="session('success')" autoDismiss="true" />
    @endif

    @if(session('error'))
        <x-admin.alert type="error" :message="session('error')" autoDismiss="true" />
    @endif

    @if(session('warning'))
        <x-admin.alert type="warning" :message="session('warning')" autoDismiss="true" />
    @endif

    @if(session('info'))
        <x-admin.alert type="info" :message="session('info')" autoDismiss="true" />
    @endif

    @if(session('status') && isset($statusMessages[session('status')]))
        <x-admin.alert type="success" :message="$statusMessages[session('status')]" autoDismiss="true" />
    @endif
</div>