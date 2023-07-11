<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll_detail extends Model
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

    public function payrolls()
    {
        return $this->belongsTo(Payroll::class, 'payroll_id', 'id');
    }

    public function payroll_categories()
    {
        return $this->belongsTo(Payroll_category::class, 'payroll_category_id', 'id');
    }
}
