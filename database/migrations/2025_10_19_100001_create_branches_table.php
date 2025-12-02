<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Translatable field
            $table->string('slug')->unique();
            $table->json('description')->nullable(); // Translatable field
            $table->string('logo')->nullable();
            $table->string('color')->default('#0028DF'); // Primary color for the branch
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default branches with translations
        DB::table('branches')->insert([
            [
                'name' => json_encode([
                    'en' => 'Kurd Genius Educational Communities',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کوردجینیەس',
                ]),
                'slug' => 'kurd-genius',
                'description' => json_encode([
                    'en' => 'Main campus of Kurd Genius Educational Communities',
                    'ckb' => 'کامپی سەرەکی کۆمەڵگای پەروەردەیی کوردجینیەس',
                ]),
                'logo' => '/img/logo.png',
                'color' => '#0028DF',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'en' => 'Kurd Genius Educational Communities 2',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کوردجینیەس ٢',
                ]),
                'slug' => 'kurd-genius-2',
                'description' => json_encode([
                    'en' => 'Second branch of Kurd Genius Educational Communities',
                    'ckb' => 'لقی دووەمی کۆمەڵگای پەروەردەیی کوردجینیەس',
                ]),
                'logo' => '/img/logo.png',
                'color' => '#5200DF',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'en' => 'Kurd Genius Educational Communities Qaiwan Heights',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کوردجینیەس بەرزاییەکانی قەیوان',
                ]),
                'slug' => 'kurd-genius-qaiwan',
                'description' => json_encode([
                    'en' => 'Qaiwan Heights campus of Kurd Genius',
                    'ckb' => 'کامپی قەیوان هایتسی کوردجینیەس',
                ]),
                'logo' => '/img/logo.png',
                'color' => '#337B7C',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'en' => 'Smart Educational Communities',
                    'ckb' => 'کۆمەڵگای پەروەردەیی سمارت',
                ]),
                'slug' => 'smart-educational',
                'description' => json_encode([
                    'en' => 'Smart Educational Communities branch',
                    'ckb' => 'لقی کۆمەڵگای پەروەردەیی سمارت',
                ]),
                'logo' => '/img/logo.png',
                'color' => '#5D5466',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
