<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 300);
            $table->string('a', 200);
            $table->string('b', 200);
            $table->string('c', 200);
            $table->string('d', 200);
            $table->string('right_ans', 10);
            $table->integer('admin_id', 15);
            $table->integer('quiz_id', 15);
            $table->integer('category_id', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcqs');
    }
};
