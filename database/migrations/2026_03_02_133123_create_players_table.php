<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('preferred_foot')->nullable();

            $table->string('position')->nullable();
            $table->string('club')->nullable();

            $table->integer('technical_rating')->nullable();
            $table->integer('physical_rating')->nullable();
            $table->integer('passing')->nullable();
            $table->integer('dribbling')->nullable();
            $table->integer('strength')->nullable();
            $table->integer('overall_rating')->nullable();

            $table->text('comments')->nullable();

            $table->string('photo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
