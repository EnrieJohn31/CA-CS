<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_mfees', function (Blueprint $table) {
            $table->id();
            $table->double('Medical');
            $table->double('Insurance');
            $table->double('Death');
            $table->double('Library');
            $table->double('School_Pub');
            $table->double('Athlet');
            $table->double('BACS');
            $table->double('Book');
            $table->double('Laboratory');
            $table->double('StudentID');
            $table->double('Passbook');
            $table->double('Handbook');
            $table->double('Dental');
            $table->double('Completers_Fee');
            $table->double('Graduation_Fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_mfees');
    }
};
