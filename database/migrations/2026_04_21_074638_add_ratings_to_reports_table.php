<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->integer('technical_rating')->nullable();
            $table->integer('physical_rating')->nullable();
            $table->integer('passing')->nullable();
            $table->integer('dribbling')->nullable();
            $table->integer('strength')->nullable();
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'technical_rating',
                'physical_rating',
                'passing',
                'dribbling',
                'strength'
            ]);
        });
    }
};
