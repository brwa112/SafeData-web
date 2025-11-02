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
        // Update news table to use news_categories
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'news_category_id')) {
                $table->foreignId('news_category_id')->nullable()->after('user_id')->constrained('news_categories')->nullOnDelete();
            }
        });

        // Update galleries table to use gallery_categories
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'gallery_category_id')) {
                $table->foreignId('gallery_category_id')->nullable()->after('branch_id')->constrained('gallery_categories')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        // Revert news table
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'news_category_id')) {
                $table->dropForeign(['news_category_id']);
                $table->dropColumn('news_category_id');
            }
        });

        // Revert galleries table
        Schema::table('galleries', function (Blueprint $table) {
            if (Schema::hasColumn('galleries', 'gallery_category_id')) {
                $table->dropForeign(['gallery_category_id']);
                $table->dropColumn('gallery_category_id');
            }
        });
    }
};
