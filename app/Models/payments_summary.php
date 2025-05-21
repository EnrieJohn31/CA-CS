<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments_summary extends Model
{
    use HasFactory;

    protected $table = 'payments_summary';

    protected $fillable = [
        'id',
        'stud_id',
        'or_num',
        'datepaid',
        'amount_paid',
        'balance',
        'updated_at',
        'created_at'
    ];
}
