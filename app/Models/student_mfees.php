<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_mfees extends Model
{
    use HasFactory;
    protected $table = 'student_mfees';

    protected $fillable = [
        'Medical',
        'Insurance',
        'Death',
        'Library',
        'School_Pub',
        'Athlet',
        'BACS',
        'Book',
        'Laboratory',
        'StudentID',
        'Passbook',
        'Handbook',
        'Dental',
        'Completers_Fee',
        'Graduation_Fee',
    ];
}
