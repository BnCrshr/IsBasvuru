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
        Schema::create('job_post_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('job_post_id');
            $table->string('question');
            $table->integer('category');
            $table->integer('question_order');
            $table->integer('required_status')->default(1);
            $table->bigInteger('application_id')->nullable();
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_questions');
    }
};
