<?php

namespace App\Listeners;

use App\Services\AuditLogger;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Events\Dispatcher;

class AuthAuditSubscriber
{
    // Method names start with "on" on purpose, so Laravel's automatic
    // event discovery does not register them a second time.
    public function onLogin(Login $event): void
    {
        AuditLogger::record('auth.login', $event->user->getAuthIdentifier(), null, null, true);
    }

    public function onLogout(Logout $event): void
    {
        AuditLogger::record('auth.logout', $event->user?->getAuthIdentifier(), null, null, true);
    }

    public function onFailed(Failed $event): void
    {
        $email = $event->credentials['email'] ?? 'unknown';
        AuditLogger::record('auth.failed', $event->user?->getAuthIdentifier(), null, "Failed login for {$email}", true);
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            Login::class  => 'onLogin',
            Logout::class => 'onLogout',
            Failed::class => 'onFailed',
        ];
    }
}
