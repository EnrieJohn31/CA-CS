<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_payables extends Model
{
    use HasFactory;

    protected $table = 'student_payables';

    protected $fillable = [
        'grade_lvl',
        'registration_fee',
        'tuition_fee',
        'uniform_fee',
        'updated_at',
        'created_at',
    ];
}
