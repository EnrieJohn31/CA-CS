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
        Schema::create('student_payables', function (Blueprint $table) {
            $table->id();
            $table->integer('grade_lvl');
            $table->double('registration_fee');
            $table->double('tuition_fee');
            $table->double('uniform_fee');
            $table->timestamp('updated_at')->default(now());
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payables');
    }
};

