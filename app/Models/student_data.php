<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student_data extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'student_data';

    protected $fillable = [
        'id',
        'Id_num',
        'name',
        'section',
        'lvl',
        'strand',
        'ay',
        'reg_fee',
        'phonenumber',
        'tui_fee',
        'uni_fee',
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
        'oth_fee',
        'total_fee',
        'or_no',
        'datepaid',
        'amount_paid',
        'balance'
    ];
}
