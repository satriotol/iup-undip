<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'fcm_token'
    ];
    const GENDER = [
        'PRIA', 'WANITA'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user_mahasiswa()
    {
        return $this->hasOne(UserMahasiswa::class, 'user_id', 'id');
    }
    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';
            $guard = $guard ?: $this->getDefaultGuardName();

            return $this->getRoleClass()->{$method}($role, $guard);
        }, $roles);

        return $query->whereHas('roles', function ($query) use ($roles) {
            $query->where(function ($query) use ($roles) {
                foreach ($roles as $role) {
                    $query->where(config('permission.table_names.roles') . '.id', '!=', $role->id);
                }
            });
        });
    }
    public static function getUserRole($user)
    {
        return $user->getRoleNames()->first() ?? '-';
    }
    public static function getUser($user)
    {
        if (Auth::user()->user_mahasiswa) {
            return User::where('id', Auth::user()->id)->get();
        } elseif ($user->getUserRole($user) != 'SUPERADMIN') {
            return User::whereDoesntHave('user_mahasiswa')->notRole('SUPERADMIN')->get();
        } elseif (Auth::user()->email != 'satriotol69@gmail.com') {
            return User::whereDoesntHave('user_mahasiswa')->where('email', '!=', 'satriotol69@gmail.com')->get();
        } else {
            return User::whereDoesntHave('user_mahasiswa')->get();
        }
    }
    public static function getRoles($user)
    {
        if ($user->getUserRole($user) != 'SUPERADMIN') {
            return Role::where('name', '!=', 'SUPERADMIN')->where('name', '!=', 'MAHASISWA_REGISTER')->where('name', '!=', 'MAHASISWA')->where('name', '!=', 'MAHASISWA_WAITING')->get();
        } else {
            return Role::all();
        }
    }
}
