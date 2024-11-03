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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title',64);
            $table->text('description');
            $table->string('languages', 64);
            $table->boolean('completed')->default(false);
            $table->date('starting_date')->nullable();
            $table->text('type',64)->nullable(); //con tipo mi riferisco a front-end/back-end
            $table->text('level', 64)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
