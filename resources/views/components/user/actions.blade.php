@if ($id !== $auth)
    <x-user.account-status :status="$status" />
    <x-user.action-btn :id="$id" />
@else
    <x-user.login-status />
@endif
