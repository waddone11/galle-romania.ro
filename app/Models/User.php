<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * Default in-memory identic cu default-ul coloanei, ca modelele noi
     * (ne-refresh-uite) sa aiba rolul corect.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'role' => 'client',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Gate-ul panoului e coloana `role` (admin|client) — o singura sursa de
        // adevar pentru front-end si Filament. Autorizarea per-resursa ramane
        // pe shield policies (roluri Spatie).
        return $this->role === 'admin';
    }
}
