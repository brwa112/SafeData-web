<?php

use App\Models\Pages\Branch;
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
        Schema::table('academic_chooses', function (Blueprint $table) {
            $table->foreignIdFor(Branch::class)->after('user_id')->nullable()->constrained()->cascadeOnDelete();
        });

        Schema::table('academic_approaches', function (Blueprint $table) {
            $table->foreignIdFor(Branch::class)->after('user_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_chooses', function (Blueprint $table) {
            $table->dropForeignIdFor(Branch::class);
            $table->dropColumn('branch_id');
        });

        Schema::table('academic_approaches', function (Blueprint $table) {
            $table->dropForeignIdFor(Branch::class);
            $table->dropColumn('branch_id');
        });
    }
};
