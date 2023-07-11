<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $guarded = [
        // 'id',
    ];

    protected $hidden = [
        'id',
    ];

    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
