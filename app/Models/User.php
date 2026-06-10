<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'is_admin', 'role', 'active'];
    protected $hidden   = ['password', 'remember_token'];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
            'active'            => 'boolean',
        ];
    }

    public function isAdmin(): bool   { return $this->role === 'admin' || $this->is_admin; }
    public function isEditor(): bool  { return $this->role === 'editor'; }
    public function canManageUsers(): bool    { return $this->isAdmin(); }
    public function canManageSettings(): bool { return $this->isAdmin(); }
}
