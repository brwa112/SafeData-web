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
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->json('address')->nullable(); // Translatable field
            $table->string('map_url')->nullable();
            $table->integer('order')->default(0);
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
                    'ar' => 'مجتمعات كردجينيوس التعليمية'
                ]),
                'slug' => 'kurd-genius',
                'description' => json_encode([
                    'en' => 'Main campus of Kurd Genius Educational Communities',
                    'ckb' => 'کامپی سەرەکی کۆمەڵگای پەروەردەیی کوردجینیەس',
                    'ar' => 'الحرم الرئيسي لمجتمعات كردجينيوس التعليمية'
                ]),
                'logo' => '/img/logo.png',
                'color' => '#0028DF',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'en' => 'Kurd Genius Educational Communities 2',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کوردجینیەس ٢',
                    'ar' => 'مجتمعات كردجينيوس التعليمية ٢'
                ]),
                'slug' => 'kurd-genius-2',
                'description' => json_encode([
                    'en' => 'Second branch of Kurd Genius Educational Communities',
                    'ckb' => 'لقی دووەمی کۆمەڵگای پەروەردەیی کوردجینیەس',
                    'ar' => 'الفرع الثاني لمجتمعات كردجينيوس التعليمية'
                ]),
                'logo' => '/img/logo.png',
                'color' => '#5200DF',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'en' => 'Kurd Genius Educational Communities Qaiwan Heights',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کوردجینیەس قەیوان هایتس',
                    'ar' => 'مجتمعات كردجينيوس التعليمية قيوان هايتس'
                ]),
                'slug' => 'kurd-genius-qaiwan',
                'description' => json_encode([
                    'en' => 'Qaiwan Heights campus of Kurd Genius',
                    'ckb' => 'کامپی قەیوان هایتسی کوردجینیەس',
                    'ar' => 'حرم قيوان هايتس لكردجينيوس'
                ]),
                'logo' => '/img/logo.png',
                'color' => '#337B7C',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode([
                    'en' => 'Smart Educational Communities',
                    'ckb' => 'کۆمەڵگای پەروەردەیی سمارت',
                    'ar' => 'المجتمعات التعليمية الذكية'
                ]),
                'slug' => 'smart-educational',
                'description' => json_encode([
                    'en' => 'Smart Educational Communities branch',
                    'ckb' => 'لقی کۆمەڵگای پەروەردەیی سمارت',
                    'ar' => 'فرع المجتمعات التعليمية الذكية'
                ]),
                'logo' => '/img/logo.png',
                'color' => '#5D5466',
                'order' => 4,
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
