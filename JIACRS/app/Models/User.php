<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;   // HasRoles added

    // 'role' removed from $fillable: roles are now managed by Spatie,
    // and leaving it here would let anyone mass-assign a role.
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Reports submitted by user
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Investigations assigned
    public function investigations()
    {
        return $this->hasMany(
            Investigation::class,
            'investigator_id'
        );
    }

    // Comments
    public function comments()
    {
        return $this->hasMany(
            CaseComment::class
        );
    }

    // Audit Logs
    public function auditLogs()
    {
        return $this->hasMany(
            AuditLog::class
        );
    }

    // NOTE: the custom notifications() relationship was removed.
    // The Notifiable trait already provides notifications(),
    // unreadNotifications() and readNotifications() using Laravel's
    // standard notifications table. Redefining it breaks the navbar bell.
}