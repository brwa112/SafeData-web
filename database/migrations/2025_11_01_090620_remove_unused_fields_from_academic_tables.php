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
        // Remove title and subtitle from academic_chooses
        Schema::table('academic_chooses', function (Blueprint $table) {
            $table->dropColumn(['title', 'subtitle']);
        });

        // Remove title and subtitle from academic_approaches
        Schema::table('academic_approaches', function (Blueprint $table) {
            $table->dropColumn(['title', 'subtitle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back title and subtitle to academic_chooses
        Schema::table('academic_chooses', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
        });

        // Add back title and subtitle to academic_approaches
        Schema::table('academic_approaches', function (Blueprint $table) {
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
        });
    }
};
