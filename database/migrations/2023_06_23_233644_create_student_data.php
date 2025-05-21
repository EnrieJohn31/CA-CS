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
        Schema::create('student_data', function (Blueprint $table) {
            $table->id();
            $table->string('Id_num')->unique();
            $table->string('name');
            $table->string('section');
            $table->integer('lvl');
            $table->string('strand')->nullable();
            $table->string('ay');
            $table->double('reg_fee');
            $table->string('or_no')->nullable()->unique();
            $table->double('tui_fee')->nullable();
            $table->double('uni_fee')->nullable();
            $table->double('oth_fee')->nullable();
            $table->double('total_fee', 9, 2)->nullable();
            $table->string('phonenumber')->nullable();
            $table->date('datepaid')->nullable();
            $table->double('amount_paid', 9, 2)->nullable();
            $table->double('balance', 9, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_data');
    }
};
