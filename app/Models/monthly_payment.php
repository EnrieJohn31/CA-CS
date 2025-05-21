<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monthly_payment extends Model
{
    use HasFactory;

    protected $table = 'monthly_payments';

    protected $fillable = [
        'id',
        'stud_id',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'updated_at',
        'created_at'
    ];
}
