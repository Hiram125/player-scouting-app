
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
            $table->integer('age');
            $table->string('position');
            $table->string('club')->nullable();

            // Attributes from your controller
            $table->integer('pace');
            $table->integer('shooting');
            $table->integer('passing');
            $table->integer('dribbling');
            $table->integer('strength');
            $table->text('comments')->nullable();

            // Match statistics
            $table->integer('matches')->default(0);
            $table->integer('goals')->default(0);
            $table->integer('assists')->default(0);
            $table->integer('minutes_played')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};