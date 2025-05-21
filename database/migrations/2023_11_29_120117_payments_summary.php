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
        Schema::create('payments_summary', function (Blueprint $table) {
            $table->id();
            $table->string('stud_id');
            $table->text('or_num');
            $table->date('datepaid');
            $table->double('amount_paid');
            $table->double('balance');
            $table->timestamp('updated_at')->default(now());
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments_summary');
    }
};
