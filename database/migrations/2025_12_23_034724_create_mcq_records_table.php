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
        Schema::create('mcq_records', function (Blueprint $table) {
             $table->id();
            $table->integer('record_id',10);
            $table->integer('user_id',10);
            $table->integer('mcq_id',10);
            $table->string('select_answer',50);
            $table->integer('is_correct',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_records');
    }
};
