<?php

namespace App\Imports;

use App\Models\student_data;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentBatchImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new student_data([
                'Id_num' =>     $row[0],
                'name' =>       $row[1],
                'section' =>    $row[2],
                'lvl' =>        $row[3],
                'strand' =>     $row[4],
                'ay' =>         $row[5],
                'reg_fee' =>    $row[6],
                'phonenumber' => $row[7],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
