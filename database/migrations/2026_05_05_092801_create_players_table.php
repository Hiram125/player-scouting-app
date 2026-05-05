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

            // CORE INFO
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('position');
            $table->string('club')->nullable();
            $table->string('nationality')->nullable();
            $table->string('preferred_foot')->nullable();

            // TECHNICAL
            $table->integer('passing')->nullable();
            $table->integer('dribbling')->nullable();
            $table->integer('shooting')->nullable();
            $table->integer('first_touch')->nullable();
            $table->integer('crossing')->nullable();
            $table->integer('heading')->nullable();

            // PHYSICAL
            $table->integer('strength')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('stamina')->nullable();
            $table->integer('agility')->nullable();

            // MENTAL
            $table->integer('composure')->nullable();
            $table->integer('work_ethic')->nullable();
            $table->integer('decision_making')->nullable();

            // RATINGS (optional but useful)
            $table->integer('technical_rating')->nullable();
            $table->integer('physical_rating')->nullable();
            $table->integer('overall_rating')->nullable();

            // EXTRA
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
