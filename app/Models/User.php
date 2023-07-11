<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [
        // 'id',
    ];

    protected $hidden = [
        // 'id',
        'password',
        'remember_token',
    ];

    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function login_history()
    {
        return $this->hasMany(LoginHistory::class);
    }
}
