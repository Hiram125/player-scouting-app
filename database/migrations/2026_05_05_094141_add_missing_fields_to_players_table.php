<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {

            // ONLY ADD IF YOUR DB IS MISSING THESE

            if (!Schema::hasColumn('players', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('name');
            }

            if (!Schema::hasColumn('players', 'height')) {
                $table->integer('height')->nullable()->after('nationality');
            }

            if (!Schema::hasColumn('players', 'weight')) {
                $table->integer('weight')->nullable()->after('height');
            }

            if (!Schema::hasColumn('players', 'scouted_date')) {
                $table->date('scouted_date')->nullable()->after('overall_rating');
            }

        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {

            $table->dropColumn([
                'date_of_birth',
                'height',
                'weight',
                'scouted_date',
            ]);
        });
    }
};
