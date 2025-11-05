<?php

namespace Database\Seeders;

use App\Models\Pages\Home\HomeHero;
use App\Models\Pages\Home\HomeHistory;
use App\Models\Pages\Home\HomeMessage;
use App\Models\Pages\Home\HomeMission;
use App\Models\Pages\Home\HomeKnow;
use App\Models\Pages\About\AboutAbout;
use App\Models\Pages\About\AboutMessage;
use App\Models\Pages\About\AboutMission;
use App\Models\Pages\About\AboutTouch;
use App\Models\Pages\Academic\AcademicApproach;
use App\Models\Pages\Academic\AcademicChoose;
use App\Models\Pages\Admission\AdmissionPolicy;
use App\Models\Pages\Admission\AdmissionDocument;
use App\Models\Pages\CalendarEvent;
use App\Models\Pages\Calendar\CalendarAcademic;
use App\Models\Pages\Calendar\CalendarOfficial;
use App\Models\Pages\Calendar\CalendarImportant;
use App\Models\Pages\Campus;
use App\Models\Pages\Classroom;
use App\Models\Pages\News;
use App\Models\Pages\Gallery;
use App\Models\System\Users\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FrontendPagesSeeder extends Seeder
{
    private $categories = [];
    private $hashtags = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }

        // Get ALL branches
        $branches = \App\Models\Pages\Branch::all();

        if ($branches->isEmpty()) {
            $this->command->error('No branches found. Please run migrations first.');
            return;
        }

        // Seed global sections first (no branch_id)
        $this->command->info('Seeding global sections...');
        $this->seedAcademicApproach($user);
        $this->seedAcademicChoose($user);
        $this->seedCalendarEvents($user);
        $this->seedCategoriesAndHashtags();
        
        // Seed branch-specific sections for EACH branch
        foreach ($branches as $index => $branch) {
            $this->command->info('');
            $this->command->info("Seeding Branch " . ($index + 1) . ": {$branch->getTranslation('name', 'en')}");
            
            $this->seedHomeHero($user, $branch);
            $this->seedHomeHistory($user, $branch);
            $this->seedHomeMessage($user, $branch);
            $this->seedHomeMission($user, $branch);
            $this->seedHomeKnow($user, $branch);
            
            $this->seedAboutAbout($user, $branch);
            $this->seedAboutMessage($user, $branch);
            $this->seedAboutMission($user, $branch);
            $this->seedAboutTouch($user, $branch);
            
            $this->seedAdmissionPolicy($user, $branch);
            $this->seedAdmissionDocuments($user, $branch);
            
            $this->seedCalendarAcademic($user, $branch);
            $this->seedCalendarOfficial($user, $branch);
            $this->seedCalendarImportant($user, $branch);
            
            $this->seedCampuses($user, $branch);
            $this->seedClassrooms($user, $branch);
            $this->seedNews($user, $branch);
            $this->seedGallery($user, $branch);
        }

        $this->command->info('');
        $this->command->info('✅ Frontend pages seeded successfully for ALL branches!');
    }

    /**
     * Get branch-specific data for customization
     */
    private function getBranchSpecificData($branch, $section)
    {
        $branchData = [
            'kurd-genius' => [
                'hero_metadata' => [
                    'expert_tutors' => '100',
                    'students' => '2000',
                    'years_experience' => '12',
                    'campuses' => '3',
                ],
                'contact_phone' => '+964 770 342 0606',
                'contact_email' => 'kurdgeniusschool@gmail.com',
                'social_youtube' => 'https://www.youtube.com/@kurdgenius',
                'social_facebook' => 'https://www.facebook.com/kurdgenius',
                'social_instagram' => 'https://www.instagram.com/kurdgenius',
                'social_twitter' => 'https://twitter.com/kurdgenius',
            ],
            'kurd-genius-2' => [
                'hero_metadata' => [
                    'expert_tutors' => '85',
                    'students' => '1600',
                    'years_experience' => '10',
                    'campuses' => '2',
                ],
                'contact_phone' => '+964 770 342 0607',
                'contact_email' => 'kurdgenius2@gmail.com',
                'social_youtube' => 'https://www.youtube.com/@kurdgenius',
                'social_facebook' => 'https://www.facebook.com/kurdgenius',
                'social_instagram' => 'https://www.instagram.com/kurdgenius',
                'social_twitter' => 'https://twitter.com/kurdgenius',
            ],
            'kurd-genius-qaiwan' => [
                'hero_metadata' => [
                    'expert_tutors' => '90',
                    'students' => '1800',
                    'years_experience' => '11',
                    'campuses' => '2',
                ],
                'contact_phone' => '+964 770 342 0608',
                'contact_email' => 'qaiwan@kurdgenius.com',
                'social_youtube' => 'https://www.youtube.com/@kurdgenius',
                'social_facebook' => 'https://www.facebook.com/kurdgenius',
                'social_instagram' => 'https://www.instagram.com/kurdgenius',
                'social_twitter' => 'https://twitter.com/kurdgenius',
            ],
            'smart-educational' => [
                'hero_metadata' => [
                    'expert_tutors' => '75',
                    'students' => '1400',
                    'years_experience' => '8',
                    'campuses' => '1',
                ],
                'contact_phone' => '+964 770 342 0609',
                'contact_email' => 'smart@educational.com',
                'social_youtube' => 'https://www.youtube.com/@smarteducational',
                'social_facebook' => 'https://www.facebook.com/smarteducational',
                'social_instagram' => 'https://www.instagram.com/smarteducational',
                'social_twitter' => 'https://twitter.com/smarteducational',
            ],
        ];

        return $branchData[$branch->slug][$section] ?? $branchData['kurd-genius'][$section];
    }

    /**
     * Seed categories and hashtags once (global data)
     */
    private function seedCategoriesAndHashtags()
    {
        // News Categories
        $newsCategories = [
            [
                'name' => ['en' => 'Achievement', 'ckb' => 'دەستکەوت', 'ar' => 'إنجاز'],
                'slug' => 'achievement',
            ],
            [
                'name' => ['en' => 'Facilities', 'ckb' => 'ئامێرەکان', 'ar' => 'المرافق'],
                'slug' => 'facilities',
            ],
            [
                'name' => ['en' => 'Events', 'ckb' => 'بۆنەکان', 'ar' => 'الفعاليات'],
                'slug' => 'events',
            ],
        ];

        foreach ($newsCategories as $category) {
            $this->categories[$category['slug']] = \App\Models\Pages\NewsCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Gallery Categories
        $galleryCategoriesData = [
            [
                'name' => ['en' => 'Campus Life', 'ckb' => 'ژیانی کامپەس', 'ar' => 'الحياة الجامعية'],
                'slug' => 'campus-life',
            ],
            [
                'name' => ['en' => 'Laboratories', 'ckb' => 'تاقیگەکان', 'ar' => 'المختبرات'],
                'slug' => 'laboratories',
            ],
            [
                'name' => ['en' => 'Cultural Events', 'ckb' => 'بۆنە کولتوورییەکان', 'ar' => 'الفعاليات الثقافية'],
                'slug' => 'cultural-events',
            ],
        ];

        // Store gallery categories separately (not in $this->categories)
        foreach ($galleryCategoriesData as $category) {
            \App\Models\Pages\GalleryCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $hashtags = [
            ['name' => ['en' => 'Excellence', 'ckb' => 'باشی', 'ar' => 'التميز'], 'slug' => 'excellence'],
            ['name' => ['en' => 'Science', 'ckb' => 'زانست', 'ar' => 'العلوم'], 'slug' => 'science'],
            ['name' => ['en' => 'Achievement', 'ckb' => 'دەستکەوت', 'ar' => 'الإنجاز'], 'slug' => 'achievement'],
            ['name' => ['en' => 'STEM', 'ckb' => 'STEM', 'ar' => 'STEM'], 'slug' => 'stem'],
            ['name' => ['en' => 'Innovation', 'ckb' => 'داهێنان', 'ar' => 'الابتكار'], 'slug' => 'innovation'],
            ['name' => ['en' => 'Education', 'ckb' => 'پەروەردە', 'ar' => 'التعليم'], 'slug' => 'education'],
            ['name' => ['en' => 'Culture', 'ckb' => 'کولتوور', 'ar' => 'الثقافة'], 'slug' => 'culture'],
            ['name' => ['en' => 'Diversity', 'ckb' => 'جۆراوجۆری', 'ar' => 'التنوع'], 'slug' => 'diversity'],
            ['name' => ['en' => 'Community', 'ckb' => 'کۆمەڵگا', 'ar' => 'المجتمع'], 'slug' => 'community'],
        ];

        foreach ($hashtags as $hashtag) {
            $this->hashtags[$hashtag['slug']] = \App\Models\Pages\Hashtag::updateOrCreate(
                ['slug' => $hashtag['slug']],
                $hashtag
            );
        }

        $this->command->info('Categories and hashtags seeded.');
    }

    // HOME PAGE SEEDERS
    private function seedHomeHero($user, $branch)
    {
        $metadata = $this->getBranchSpecificData($branch, 'hero_metadata');
        $branchNames = $branch->getTranslations('name');

        HomeHero::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'title' => [
                'en' => $branchNames['en'] ?? '',
                'ckb' => $branchNames['ckb'] ?? '',
                'ar' => $branchNames['ar'] ?? $branchNames['ckb'] ?? '',
            ],
            'subtitle' => [
                'en' => 'Quality Education, Bright Future',
                'ckb' => 'پەروەردەی باش، داهاتووی گەشاوە',
                'ar' => 'تعليم جيد، مستقبل مشرق',
            ],
            'metadata' => $metadata,
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Home hero seeded');
    }

    private function seedHomeHistory($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        HomeHistory::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => "Founded in 2013 by Maya Company, {$branchNames['en']} has grown to become one of the leading educational institutions in the Kurdistan Region. Over the years, we have maintained our commitment to excellence, producing graduates who excel in universities and contribute meaningfully to society.",
                'ckb' => "{$branchNames['ckb']} لە ساڵی ٢٠١٣دا لەلایەن کۆمپانیای مایاوە دامەزراوە و بووەتە یەکێک لە پێشەنگترین دامەزراوە پەروەردەییەکانی هەرێمی کوردستان. لە ماوەی ساڵانی ڕابردوودا، پابەندبووینمان بە باشی پاراستووە و دەرچووانێکمان بەرهەمهێناوە کە لە زانکۆکاندا سەرکەوتوون و بەشێوەیەکی بەنرخ بەشداری کۆمەڵگا دەکەن.",
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Home history seeded');
    }

    private function seedHomeMessage($user, $branch)
    {
        HomeMessage::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => 'We are committed to providing high-quality education that nurtures intellectual curiosity, critical thinking, and personal growth. Our dedicated team of educators works tirelessly to ensure that every student receives the support and guidance they need to succeed.',
                'ckb' => 'ئێمە پابەندین بە دابینکردنی پەروەردەیەکی باش کە کنجکاوی زیرەکانە، بیرکردنەوەی ڕەخنەگرانە و گەشەی کەسی پەروەردە دەکات. تیمی بەخشراوی پەروەردەکارانمان بێ ماندووبوون کار دەکات بۆ دڵنیابوون لەوەی کە هەر خوێندکارێک پشتیوانی و ڕێنمایی پێویستی وەردەگرێت بۆ سەرکەوتن.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Home message seeded');
    }

    private function seedHomeMission($user, $branch)
    {
        HomeMission::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => 'To deliver excellence in education through innovative teaching methods, a supportive learning environment, and a curriculum that balances academic achievement with character development. We strive to prepare students not just for exams, but for life.',
                'ckb' => 'گەیاندنی باشی لە پەروەردەدا لە ڕێگەی شێوازە نوێیەکانی وانەوتنەوە، ژینگەیەکی پشتیوانی فێربوون و مەنهەجێک کە هاوسەنگی لە نێوان دەستکەوتی ئەکادیمی و گەشەپێدانی کەسایەتیدا دروست دەکات. ئێمە هەوڵ دەدەین خوێندکاران نەک تەنها بۆ تاقیکردنەوەکان، بەڵکو بۆ ژیان ئامادە بکەین.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Home mission seeded');
    }

    private function seedHomeKnow($user, $branch)
    {
        HomeKnow::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'metadata' => [
                'youtube' => $this->getBranchSpecificData($branch, 'social_youtube'),
                'facebook' => $this->getBranchSpecificData($branch, 'social_facebook'),
                'instagram' => $this->getBranchSpecificData($branch, 'social_instagram'),
                'twitter' => $this->getBranchSpecificData($branch, 'social_twitter'),
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Home social links seeded');
    }

    // ABOUT PAGE SEEDERS
    private function seedAboutAbout($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        AboutAbout::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => "{$branchNames['en']} was established in 2013 by Maya Company, a proud member of the Qaiwan Group of Companies, and is led by Mrs. Sozan Abubakr Mawlud. Since its foundation, the school has consistently ranked among the top performing educational institutions in the Kurdistan Region.",
                'ckb' => "{$branchNames['ckb']} لە ساڵی ٢٠١٣دا لەلایەن کۆمپانیای مایاوە دامەزراوە، ئەندامێکی شانازی دەرەوەی کۆمپانیاکانی قەیوانە، و لەلایەن خاتوو سۆزان ئەبووبەکر مەولوودەوە بەڕێوە دەبرێت.",
                'ar' => "تأسست {$branchNames['ar']} في عام 2013 من قبل شركة مايا، وهي عضو فخور في مجموعة قيوان للشركات، وتديرها السيدة سوزان أبوبكر مولود.",
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ About about seeded');
    }

    private function seedAboutMessage($user, $branch)
    {
        AboutMessage::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => 'We are committed to providing high-quality education that nurtures intellectual curiosity, critical thinking, and personal growth. Our message is to empower students to become confident, compassionate, and responsible global citizens.',
                'ckb' => 'ئێمە پابەندین بە دابینکردنی پەروەردەیەکی باش کە کنجکاوی زیرەکانە، بیرکردنەوەی ڕەخنەگرانە و گەشەی کەسی پەروەردە دەکات.',
                'ar' => 'نحن ملتزمون بتوفير تعليم عالي الجودة يغذي الفضول الفكري والتفكير النقدي والنمو الشخصي.',
            ],
            'author' => [
                'en' => 'Mrs. Sozan Abubakr Mawlud',
                'ckb' => 'خاتوو سۆزان ئەبووبەکر مەولوود',
                'ar' => 'السيدة سوزان أبوبكر مولود',
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ About message seeded');
    }

    private function seedAboutMission($user, $branch)
    {
        AboutMission::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => 'To deliver excellence in education through innovative teaching methods, a supportive learning environment, and a curriculum that balances academic achievement with character development.',
                'ckb' => 'گەیاندنی باشی لە پەروەردەدا لە ڕێگەی شێوازە نوێیەکانی وانەوتنەوە و ژینگەیەکی پشتیوانی فێربوون.',
                'ar' => 'تقديم التميز في التعليم من خلال أساليب تدريس مبتكرة وبيئة تعليمية داعمة.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ About mission seeded');
    }

    private function seedAboutTouch($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        AboutTouch::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'contact_email' => $this->getBranchSpecificData($branch, 'contact_email'),
            'contact_phone' => $this->getBranchSpecificData($branch, 'contact_phone'),
            'contact_address' => [
                'en' => "{$branchNames['en']}, Educational District, Erbil, Kurdistan Region",
                'ckb' => "{$branchNames['ckb']}، دەڤەری پەروەردە، هەولێر، هەرێمی کوردستان",
                'ar' => "{$branchNames['ar']}، المنطقة التعليمية، أربيل، إقليم كوردستان",
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ About touch seeded');
    }

    // ACADEMIC PAGE SEEDERS
    private function seedAcademicApproach($user)
    {
        AcademicApproach::create([
            'user_id' => $user->id,
            'description' => [
                'en' => 'We believe in fostering a learning environment where students are active participants in their education. Our approach combines traditional wisdom with modern pedagogical methods.',
                'ckb' => 'ئێمە باوەڕمان بە پەروەردەکردنی ژینگەیەکی فێربوونە کە خوێندکاران بەشداربووی چالاکن لە پەروەردەکەیاندا.',
            ],
            'features' => [
                'en' => [
                    ['title' => 'Personalized Learning Plans'],
                    ['title' => 'Interactive Classrooms'],
                    ['title' => 'Project-Based Learning'],
                    ['title' => 'Critical Thinking Development'],
                ],
                'ckb' => [
                    ['title' => 'پلانی فێربوونی تایبەتمەند'],
                    ['title' => 'پۆلە کارلێکەرەکان'],
                    ['title' => 'فێربوونی بنەما لەسەر پرۆژە'],
                    ['title' => 'گەشەپێدانی بیرکردنەوەی ڕەخنەگرانە'],
                ],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Academic approach seeded.');
    }

    private function seedAcademicChoose($user)
    {
        AcademicChoose::create([
            'user_id' => $user->id,
            'description' => [
                'en' => 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths — ensuring academic success and emotional growth.',
                'ckb' => 'ئێمە باوەڕمان وایە هەر خوێندکارێک تایبەتە. بۆیە ڕێژەی کەمی خوێندکار بۆ مامۆستا ڕێگە بە سەرنج و ڕێگای فێربوونی تایبەتمەند دەدات.',
            ],
            'reasons' => [
                'en' => [
                    ['title' => 'Top-ranked educational institution', 'description' => 'Leading excellence in education'],
                    ['title' => 'Experienced and qualified teachers', 'description' => 'Expert educators dedicated to student success'],
                    ['title' => 'State-of-the-art facilities', 'description' => 'Modern learning environment and resources'],
                ],
                'ckb' => [
                    ['title' => 'دامەزراوەی پەروەردەی پلەی یەکەم', 'description' => 'پێشەنگی باشی لە پەروەردەدا'],
                    ['title' => 'مامۆستایانی شارەزا و شایستە', 'description' => 'مامۆستایانی پسپۆڕ تەرخانکراو بۆ سەرکەوتنی خوێندکار'],
                    ['title' => 'کەرەستەی سەردەم', 'description' => 'ژینگەی فێربوونی مۆدێرن و سەرچاوەکان'],
                ],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Academic choose seeded.');
    }

    // ADMISSION PAGE SEEDERS
    private function seedAdmissionPolicy($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        AdmissionPolicy::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => "{$branchNames['en']} maintains a fair and transparent admission process. We welcome students from diverse backgrounds who demonstrate a genuine interest in learning and personal growth.",
                'ckb' => "{$branchNames['ckb']} پرۆسەیەکی دادپەروەرانە و ڕوونی وەرگرتنی هەیە. ئێمە پێشوازی لە خوێندکاران دەکەین لە پاشخانە جیاوازەکانەوە.",
            ],
            'requirements' => [
                'en' => 'Students must meet age requirements, submit required documents, pass entrance assessment, and attend an interview with parents.',
                'ckb' => 'خوێندکاران دەبێت پێداویستیەکانی تەمەن پڕبکەنەوە، بەڵگەنامە پێویستەکان پێشکەش بکەن، هەڵسەنگاندنی چوونەژوورەوە تێبپەڕێنن، و لەگەڵ دایک و باوک چاوپێکەوتنێک ئەنجام بدەن.',
            ],
            'steps' => [
                'en' => [
                    ['level' => 'First', 'title' => 'Entrance assessment & interview'],
                    ['level' => 'Second', 'title' => 'Review of academic records and conduct'],
                    ['level' => 'Third', 'title' => 'Preference for early applicants and siblings'],
                    ['level' => 'Fourth', 'title' => 'Final approval by the admissions committee'],
                    ['level' => 'Read', 'title' => 'School reception'],
                    ['level' => 'Download', 'title' => 'Download from our official website'],
                    ['level' => 'Message', 'title' => 'Email request: ' . $this->getBranchSpecificData($branch, 'contact_email')],
                ],
                'ckb' => [
                    // First 4 cards - Admission Process Steps
                    ['level' => 'یەکەم', 'title' => 'هەڵسەنگاندن و چاوپێکەوتنی چوونەژوورەوە'],
                    ['level' => 'دووەم', 'title' => 'پێداچوونەوەی تۆمارەکانی ئەکادیمی و ڕەفتار'],
                    ['level' => 'سێیەم', 'title' => 'ئەولەویەت بۆ داواکارانی زوو و خوشک و براکان'],
                    ['level' => 'چوارەم', 'title' => 'پەسەندکردنی کۆتایی لەلایەن لیژنەی وەرگرتنەوە'],
                    // Last 3 cards - Application Methods
                    ['level' => 'خوێندنەوە', 'title' => 'وەرگرتنی قوتابخانە'],
                    ['level' => 'داگرتن', 'title' => 'داگرتن لە ماڵپەڕی فەرمیمان'],
                    ['level' => 'نامە', 'title' => 'داواکاری ئیمەیڵ: kurdgeniusschool@gmail.com'],
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Admission policy seeded');
    }

    private function seedAdmissionDocuments($user, $branch)
    {
        AdmissionDocument::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'documents' => [
                'en' => [
                    ['title' => 'Copy of passport or national ID', 'icon' => '/img/admission/passport.svg'],
                    ['title' => '6 recent passport-sized photos', 'icon' => '/img/admission/editing.svg'],
                    ['title' => 'Academic transcripts or report cards', 'icon' => '/img/admission/report.svg'],
                    ['title' => 'Medical & vaccination records', 'icon' => '/img/admission/medicine.svg'],
                ],
                'ckb' => [
                    ['title' => 'کۆپی پاسپۆرت یان ناسنامەی نیشتمانی', 'icon' => '/img/admission/passport.svg'],
                    ['title' => '٦ وێنەی پاسپۆرتی نوێ', 'icon' => '/img/admission/editing.svg'],
                    ['title' => 'پەڕگەکانی ئەکادیمی یان کارتی ڕاپۆرت', 'icon' => '/img/admission/report.svg'],
                    ['title' => 'تۆمارەکانی پزیشکی و کوتان', 'icon' => '/img/admission/medicine.svg'],
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Admission documents seeded');
    }

    // EXISTING SEEDERS (Calendar, Campus, Classroom, News)
    private function seedCalendarEvents($user)
    {
        $events = [
            [
                'title' => 'First Day of School',
                'description' => 'Academic year begins for all grades',
                'event_type' => 'academic',
                'start_date' => Carbon::create(2025, 9, 1),
                'color' => '#5977FE',
            ],
            [
                'title' => 'Newroz Holiday',
                'description' => 'Kurdish New Year celebration',
                'event_type' => 'official',
                'start_date' => Carbon::create(2026, 3, 21),
                'color' => '#FFC107',
            ],
            [
                'title' => 'Mid-Term Exams',
                'description' => 'First semester midterm examinations',
                'event_type' => 'exam',
                'start_date' => Carbon::create(2025, 11, 15),
                'end_date' => Carbon::create(2025, 11, 22),
                'color' => '#FF5722',
            ],
        ];

        foreach ($events as $event) {
            CalendarEvent::create(array_merge($event, ['user_id' => $user->id]));
        }

        $this->command->info('Calendar events seeded.');
    }

    private function seedCampuses($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        $campuses = [
            [
                'title' => [
                    'en' => "{$branchNames['en']} Main Campus",
                    'ckb' => "کەمپی سەرەکی {$branchNames['ckb']}",
                    'ar' => "الحرم الرئيسي {$branchNames['ar']}",
                ],
                'content' => [
                    'en' => "The {$branchNames['en']} main campus is located in a vibrant educational district, offering students access to modern classrooms, advanced science laboratories, sports facilities, and cultural centers. Our campus spans over 5 acres of beautifully landscaped grounds, providing an ideal environment for learning and personal development.",
                    'ckb' => "کەمپی سەرەکی {$branchNames['ckb']} لە ناوچەیەکی پەروەردەیی گەشاوە جێگیرە، دەرفەتی بەکارهێنانی پۆلی مۆدێرن، تاقیگەی زانستی پێشکەوتوو، ئامێری وەرزشی و ناوەندە کولتووریەکان بۆ قوتابیان دابین دەکات. کەمپەکەمان زیاتر لە ۵ ئێکەر زەوی جوان و سەوز دەگرێتەوە.",
                    'ar' => "يقع الحرم الرئيسي {$branchNames['ar']} في منطقة تعليمية نابضة بالحياة، ويوفر للطلاب الوصول إلى الفصول الدراسية الحديثة والمختبرات العلمية المتقدمة والمرافق الرياضية والمراكز الثقافية. يمتد حرمنا الجامعي على مساحة تزيد عن 5 أفدنة من الأراضي المنسقة بشكل جميل.",
                ],
                'views' => rand(50, 200),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Science & Technology Wing',
                    'ckb' => 'باڵی زانست و تەکنەلۆژیا',
                    'ar' => 'جناح العلوم والتكنولوجيا',
                ],
                'content' => [
                    'en' => "Our Science & Technology Wing features state-of-the-art laboratories, computer labs, and innovation centers. Students have access to cutting-edge equipment for physics, chemistry, biology, and robotics. The wing includes dedicated spaces for STEM projects, coding workshops, and scientific research.",
                    'ckb' => "باڵی زانست و تەکنەلۆژیامان تاقیگە و لابی کۆمپیوتەری مۆدێرن و ناوەندی داهێنان لەخۆدەگرێت. قوتابیان دەتوانن ئامێرە پێشکەوتووەکان بۆ فیزیا، کیمیا، بایۆلۆجی و ڕۆبۆتیکس بەکاربهێنن. باڵەکە شوێنی تایبەت بۆ پڕۆژەی STEM و وۆرکشۆپی کۆدنووسین و لێکۆڵینەوەی زانستی لەخۆدەگرێت.",
                    'ar' => "يحتوي جناح العلوم والتكنولوجيا لدينا على مختبرات حديثة ومختبرات حاسوب ومراكز ابتكار. يتمتع الطلاب بإمكانية الوصول إلى المعدات المتطورة للفيزياء والكيمياء والبيولوجيا والروبوتات. يتضمن الجناح مساحات مخصصة لمشاريع STEM وورش البرمجة والبحث العلمي.",
                ],
                'views' => rand(50, 200),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Sports & Recreation Complex',
                    'ckb' => 'کۆمپلێکسی وەرزش و کاتی بەتاڵ',
                    'ar' => 'مجمع الرياضة والترفيه',
                ],
                'content' => [
                    'en' => "The Sports & Recreation Complex offers comprehensive athletic facilities including an indoor gymnasium, outdoor playing fields, swimming pool, and fitness center. We support various sports programs including basketball, football, volleyball, swimming, and athletics. Regular tournaments and inter-school competitions are organized to promote sportsmanship and teamwork.",
                    'ckb' => "کۆمپلێکسی وەرزش و کاتی بەتاڵ ئامێری وەرزشی گشتگیر پێشکەش دەکات لەوانە زەوی لیستنی ناوخۆیی، گۆڕەپانی دەرەکی یاری، حەوزی مەلەوانی، و ناوەندی لەشجوانی. پشتیوانی لە پڕۆگرامە وەرزشییەکان دەکەین وەک تۆپی سەبەتە، تۆپی پێ، تۆپی بالیبال، مەلەوانی و ڕاکردن. پاڵەوانەتی و ڕکابەری نێوان قوتابخانەکان بە بەردەوامی ڕێکدەخرێت.",
                    'ar' => "يوفر مجمع الرياضة والترفيه مرافق رياضية شاملة بما في ذلك صالة رياضية داخلية وملاعب خارجية ومسبح ومركز للياقة البدنية. ندعم برامج رياضية متنوعة بما في ذلك كرة السلة وكرة القدم والكرة الطائرة والسباحة وألعاب القوى. يتم تنظيم البطولات والمسابقات بين المدارس بانتظام لتعزيز الروح الرياضية والعمل الجماعي.",
                ],
                'views' => rand(50, 200),
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Library & Learning Resource Center',
                    'ckb' => 'کتێبخانە و ناوەندی سەرچاوەی فێربوون',
                    'ar' => 'المكتبة ومركز موارد التعلم',
                ],
                'content' => [
                    'en' => "Our comprehensive library houses over 10,000 books, digital resources, and multimedia materials in multiple languages. The Learning Resource Center provides quiet study areas, group discussion rooms, and computer workstations. Students have access to online databases, e-books, and research journals to support their academic pursuits.",
                    'ckb' => "کتێبخانە گشتگیرەکەمان زیاتر لە ١٠،٠٠٠ کتێب، سەرچاوەی دیجیتاڵ و کەرەستەی ڕاگەیاندنی فرە لەخۆدەگرێت بە چەندین زمان. ناوەندی سەرچاوەی فێربوون شوێنی بێدەنگ بۆ خوێندن، ژووری گفتوگۆی گرووپی و وێستگەی کاری کۆمپیوتەر دابین دەکات. قوتابیان دەتوانن دەستیان بە بنکەدراوە ئۆنلاینەکان، کتێبی ئەلیکترۆنی و گۆڤاری لێکۆڵینەوە بگات.",
                    'ar' => "تضم مكتبتنا الشاملة أكثر من 10000 كتاب وموارد رقمية ومواد متعددة الوسائط بلغات متعددة. يوفر مركز موارد التعلم مناطق دراسة هادئة وغرف مناقشة جماعية ومحطات عمل حاسوبية. يتمتع الطلاب بإمكانية الوصول إلى قواعد البيانات عبر الإنترنت والكتب الإلكترونية والمجلات البحثية لدعم متابعاتهم الأكاديمية.",
                ],
                'views' => rand(50, 200),
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Arts & Culture Center',
                    'ckb' => 'ناوەندی هونەر و کولتوور',
                    'ar' => 'مركز الفنون والثقافة',
                ],
                'content' => [
                    'en' => "The Arts & Culture Center celebrates creativity through music, drama, visual arts, and cultural events. Our facilities include art studios, music rooms, a theater, and exhibition spaces. Students can explore various artistic disciplines and participate in performances, exhibitions, and cultural festivals throughout the year.",
                    'ckb' => "ناوەندی هونەر و کولتوور داهێنان لە ڕێگەی مۆسیقا، دراما، هونەری بینراو و بۆنە کولتوورییەکانەوە ئاهەنگ دەگرێت. ئامێرەکانمان ستودیۆی هونەر، ژووری مۆسیقا، شانۆگەر و شوێنی پێشانگا لەخۆدەگرێت. قوتابیان دەتوانن بوارە هونەرییە جۆراوجۆرەکان بەدوا بکەون و بەشدار بن لە نمایش، پێشانگا و فێستیڤاڵە کولتوورییەکان.",
                    'ar' => "يحتفي مركز الفنون والثقافة بالإبداع من خلال الموسيقى والدراما والفنون البصرية والفعاليات الثقافية. تشمل مرافقنا استوديوهات فنية وغرف موسيقى ومسرحًا ومساحات للمعارض. يمكن للطلاب استكشاف التخصصات الفنية المختلفة والمشاركة في العروض والمعارض والمهرجانات الثقافية على مدار العام.",
                ],
                'views' => rand(50, 200),
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Student Center & Cafeteria',
                    'ckb' => 'ناوەندی قوتابیان و چێشتخانە',
                    'ar' => 'مركز الطلاب والكافتيريا',
                ],
                'content' => [
                    'en' => "The Student Center serves as the social hub of campus life, featuring comfortable lounges, recreation areas, and our modern cafeteria. The cafeteria offers nutritious meals prepared fresh daily, accommodating various dietary requirements. This is where students gather, socialize, and build lasting friendships in a welcoming environment.",
                    'ckb' => "ناوەندی قوتابیان وەک ناوەندی کۆمەڵایەتی ژیانی کەمپ کاردەکات، شوێنی پشوودانی ئاسوودە، شوێنی کاتی بەتاڵ و چێشتخانەی مۆدێرنمان لەخۆدەگرێت. چێشتخانە خواردنی تەندروست پێشکەش دەکات کە ڕۆژانە تازە ئامادەدەکرێت. ئەمە شوێنێکە کە قوتابیان کۆدەبنەوە، پێکەوە کات بەسەردەبەن و هاوڕێیەتی درێژخایەن دروست دەکەن.",
                    'ar' => "يعمل مركز الطلاب كمحور اجتماعي لحياة الحرم الجامعي، ويضم صالات مريحة ومناطق ترفيهية وكافتيريا حديثة. توفر الكافتيريا وجبات مغذية يتم إعدادها طازجة يوميًا، وتستوعب متطلبات غذائية مختلفة. هذا هو المكان الذي يجتمع فيه الطلاب ويتواصلون اجتماعيًا ويبنون صداقات دائمة في بيئة ترحيبية.",
                ],
                'views' => rand(50, 200),
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Innovation & Maker Space',
                    'ckb' => 'شوێنی داهێنان و دروستکردن',
                    'ar' => 'مساحة الابتكار والإبداع',
                ],
                'content' => [
                    'en' => "Our Innovation & Maker Space empowers students to bring their ideas to life through hands-on creation and experimentation. Equipped with 3D printers, laser cutters, electronics workbenches, and crafting tools, this space encourages creativity, problem-solving, and entrepreneurial thinking. Students can work on personal projects, participate in maker challenges, and develop prototypes.",
                    'ckb' => "شوێنی داهێنان و دروستکردنمان هێز بە قوتابیان دەدات بۆ ژیاندار کردنی بیرۆکەکانیان لە ڕێگەی دروستکردن و تاقیکردنەوە. ئەم شوێنە بە پرینتەری ٣D، بڕینی لەیزەر، مێزی کاری ئەلیکترۆنیات و ئامێری پیشەکاری تێکەڵ کراوە، ئەم شوێنە داهێنان، چارەسەرکردنی کێشە و بیرکردنەوەی بازرگانی هاندەدات.",
                    'ar' => "تمكّن مساحة الابتكار والإبداع لدينا الطلاب من تحويل أفكارهم إلى واقع من خلال الإنشاء والتجريب العملي. مجهزة بطابعات ثلاثية الأبعاد وقواطع ليزر ومناضد عمل إلكترونية وأدوات الحرف اليدوية، تشجع هذه المساحة على الإبداع وحل المشكلات والتفكير الريادي.",
                ],
                'views' => rand(50, 200),
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($campuses as $campusData) {
            $campus = Campus::create(array_merge($campusData, [
                'user_id' => $user->id,
                'branch_id' => $branch->id
            ]));

            // Attach campus images (use available images from public/img/campus)
            // Distribute images across different campuses
            $imageMapping = [
                1 => [1, 2],      // Main Campus
                2 => [3, 4],      // Science & Tech
                3 => [5],         // Sports
                4 => [6],         // Library
                5 => [7],         // Arts
                6 => [1, 3],      // Student Center
                7 => [2, 4, 5],   // Innovation Space
            ];

            $imagesToAttach = $imageMapping[$campusData['order']] ?? [1];
            foreach ($imagesToAttach as $num) {
                $imagePath = public_path("img/campus/{$num}.jpg");
                if (file_exists($imagePath)) {
                    $campus->addMedia($imagePath)
                        ->preservingOriginal()
                        ->toMediaCollection('images');
                }
            }
        }

        $this->command->info('  ✓ Campuses seeded');
    }

    private function seedClassrooms($user, $branch)
    {
        $classrooms = [
            [
                'title' => [
                    'en' => 'Science Laboratory',
                    'ckb' => 'تاقیگەی زانست',
                    'ar' => 'مختبر العلوم',
                ],
                'content' => [
                    'en' => 'Our state-of-the-art science laboratory is equipped with modern technology and equipment, providing students with hands-on experience in conducting experiments and research. The laboratory includes microscopes, lab benches, safety equipment, and digital displays to support various scientific disciplines including physics, chemistry, and biology. Students learn through practical experimentation and inquiry-based learning.',
                    'ckb' => 'تاقیگە زانستیەکانمان بە تەکنەلۆژیای مۆدێرن و ئامێرەکانی پێشکەوتوو چەکدار کراوە، کە ئەزموونی مەشقی بۆ قوتابیان دابین دەکات لە ئەنجامدانی تاقیکردنەوە و توێژینەوەدا. تاقیگەکە میکرۆسکۆپ، میزی تاقیگە، ئامێری پاراستن و پیشاندەری دیجیتاڵی تێدایە بۆ پشتگیریکردنی بوارە زانستییە جیاوازەکان.',
                    'ar' => 'مختبرنا العلمي الحديث مجهز بأحدث التقنيات والمعدات، مما يوفر للطلاب خبرة عملية في إجراء التجارب والأبحاث. يشمل المختبر مجاهر ومناضد معملية ومعدات السلامة وشاشات رقمية لدعم التخصصات العلمية المختلفة.',
                ],
                'views' => rand(50, 200),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Computer Laboratory',
                    'ckb' => 'تاقیگەی کۆمپیوتەر',
                    'ar' => 'مختبر الحاسوب',
                ],
                'content' => [
                    'en' => 'Our modern computer laboratory is equipped with 40 high-performance computers, projectors, and coding software for programming classes. Students have access to industry-standard development tools and software, preparing them for careers in technology and computer science. The lab supports courses in programming, web development, graphic design, and digital literacy.',
                    'ckb' => 'تاقیگەی کۆمپیوتەری مۆدێرنەکەمان چەکدار کراوە بە ٤٠ کۆمپیوتەری بەرزکارایی، پرۆژێکتەر و نەرمەڕەقی کۆدنووسی بۆ وانەکانی بەرنامەسازی. قوتابیان دەستڕاگەیشتنیان هەیە بە ئامرازەکانی پەرەپێدان و نەرمەڕەقی ستانداردی پیشەسازی.',
                    'ar' => 'مختبر الحاسوب الحديث لدينا مجهز بـ 40 جهاز كمبيوتر عالي الأداء وأجهزة عرض وبرامج برمجة. يتمتع الطلاب بإمكانية الوصول إلى أدوات وبرامج تطوير معيارية في الصناعة.',
                ],
                'views' => rand(50, 200),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Library & Resource Center',
                    'ckb' => 'کتێبخانە و سەنتەری سەرچاوەکان',
                    'ar' => 'المكتبة ومركز الموارد',
                ],
                'content' => [
                    'en' => 'Our comprehensive library offers over 10,000 books, digital resources, and dedicated study spaces for students. The library is designed to foster a love of reading and provide resources for academic research. Features include quiet study rooms, computer access, and a wide selection of reference materials across all subjects. Professional librarians are available to assist students with research and reading recommendations.',
                    'ckb' => 'کتێبخانە گشتگیرەکەمان زیاتر لە ١٠،٠٠٠ کتێب، سەرچاوەی دیجیتاڵ و شوێنی تایبەتی خوێندن بۆ قوتابیان دابین دەکات. کتێبخانەکە دیزاین کراوە بۆ پەروەردەکردنی خۆشەویستی خوێندنەوە و دابینکردنی سەرچاوەکان بۆ توێژینەوەی ئەکادیمی.',
                    'ar' => 'تقدم مكتبتنا الشاملة أكثر من 10000 كتاب وموارد رقمية ومساحات دراسة مخصصة للطلاب. تم تصميم المكتبة لتعزيز حب القراءة وتوفير الموارد للبحث الأكاديمي.',
                ],
                'views' => rand(50, 200),
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Art Studio',
                    'ckb' => 'ستودیۆی هونەر',
                    'ar' => 'استوديو الفنون',
                ],
                'content' => [
                    'en' => 'Our spacious art studio provides a creative environment for students to explore various artistic mediums including painting, drawing, sculpture, and mixed media. The studio is equipped with professional-grade art supplies, easels, pottery wheels, and a kiln for ceramics. Students develop their artistic skills while expressing their creativity and imagination through various art forms.',
                    'ckb' => 'ستودیۆی فراوانی هونەرمان ژینگەیەکی داهێنەر دابین دەکات بۆ قوتابیان بۆ گەڕان بە ناوەندە هونەریە جۆراوجۆرەکاندا وەک نیگارکێشان، کێشان، پەیکەر و میدیای تێکەڵ. ستودیۆکە بە پێداویستیەکانی هونەری ئاستی پیشەیی چەکدار کراوە.',
                    'ar' => 'يوفر استوديو الفن الواسع لدينا بيئة إبداعية للطلاب لاستكشاف وسائط فنية مختلفة بما في ذلك الرسم والنحت والوسائط المختلطة. الاستوديو مجهز بمستلزمات فنية احترافية.',
                ],
                'views' => rand(50, 200),
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Music Room',
                    'ckb' => 'ژووری مۆسیقا',
                    'ar' => 'غرفة الموسيقى',
                ],
                'content' => [
                    'en' => 'The music room is a soundproof space designed for musical education and practice. It features a variety of instruments including pianos, guitars, drums, and traditional instruments. Students learn music theory, composition, and performance skills. The room is equipped with recording equipment and audio technology for modern music production and learning.',
                    'ckb' => 'ژووری مۆسیقا شوێنێکی دژ بە دەنگە کە دیزاین کراوە بۆ پەروەردەی مۆسیقی و مەشق. ئامێرە جۆراوجۆرەکانی مۆسیقای تێدایە وەک پیانۆ، گیتار، درامز و ئامێرە نەریتیەکان. قوتابیان تیۆری مۆسیقا و کۆمپۆزیشن و لێهاتوویی نمایش فێر دەبن.',
                    'ar' => 'غرفة الموسيقى عبارة عن مساحة عازلة للصوت مصممة للتعليم والممارسة الموسيقية. يحتوي على مجموعة متنوعة من الآلات بما في ذلك البيانو والغيتار والطبول والآلات التقليدية.',
                ],
                'views' => rand(50, 200),
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Robotics Lab',
                    'ckb' => 'تاقیگەی ڕۆبۆتیکس',
                    'ar' => 'مختبر الروبوتات',
                ],
                'content' => [
                    'en' => 'Our cutting-edge robotics lab enables students to design, build, and program robots using industry-standard equipment and software. The lab features LEGO robotics kits, Arduino boards, 3D printers, and various sensors and motors. Students participate in robotics competitions and develop problem-solving skills through hands-on engineering projects.',
                    'ckb' => 'تاقیگەی ڕۆبۆتیکسی پێشکەوتوومان توانای ئەوە بە قوتابیان دەدات کە ڕۆبۆت دیزاین بکەن، دروست بکەن و بەرنامە بۆ دابنێن بە بەکارهێنانی ئامێر و نەرمەڕەقی ستانداردی پیشەسازی. تاقیگەکە کیتی ڕۆبۆتیکسی LEGO و بۆردی Arduino و پرینتەری ٣D و هەستەوەر و مۆتۆری جۆراوجۆری تێدایە.',
                    'ar' => 'يمكّن مختبر الروبوتات المتطور لدينا الطلاب من تصميم وبناء وبرمجة الروبوتات باستخدام المعدات والبرامج القياسية في الصناعة. يحتوي المختبر على مجموعات روبوتات LEGO ولوحات Arduino وطابعات ثلاثية الأبعاد.',
                ],
                'views' => rand(50, 200),
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Multipurpose Hall',
                    'ckb' => 'هۆڵی فرە مەبەست',
                    'ar' => 'القاعة متعددة الأغراض',
                ],
                'content' => [
                    'en' => 'The multipurpose hall is a versatile space used for assemblies, performances, sports activities, and special events. The hall can accommodate up to 500 people and is equipped with a professional sound system, lighting, and projection equipment. It serves as the heart of school events and community gatherings, hosting everything from graduation ceremonies to cultural performances.',
                    'ckb' => 'هۆڵی فرە مەبەست شوێنێکی فرە بەکارە کە بەکاردێت بۆ کۆبوونەوە، نمایش، چالاکی وەرزشی و بۆنە تایبەتەکان. هۆڵەکە دەتوانێت تا ٥٠٠ کەس بگرێتەوە و بە سیستەمی دەنگی پیشەیی، ڕووناکی و ئامێری پرۆژێکشن چەکدار کراوە.',
                    'ar' => 'القاعة متعددة الأغراض عبارة عن مساحة متعددة الاستخدامات تستخدم للتجمعات والعروض والأنشطة الرياضية والفعاليات الخاصة. يمكن للقاعة استيعاب ما يصل إلى 500 شخص ومجهزة بنظام صوت احترافي وإضاءة ومعدات عرض.',
                ],
                'views' => rand(50, 200),
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($classrooms as $classroomData) {
            $classroom = Classroom::create(array_merge($classroomData, [
                'user_id' => $user->id,
                'branch_id' => $branch->id
            ]));

            // Attach classroom images (use available images from public/img/class)
            // Distribute images across different classrooms
            $imageMapping = [
                1 => [1],         // Science Lab
                2 => [2, 3],      // Computer Lab
                3 => [4],         // Library
                4 => [5],         // Art Studio
                5 => [6],         // Music Room
                6 => [7],         // Robotics Lab
                7 => [1, 2],      // Multipurpose Hall
            ];

            $imagesToAttach = $imageMapping[$classroomData['order']] ?? [1];
            foreach ($imagesToAttach as $num) {
                $imagePath = public_path("img/class/{$num}.jpg");
                if (file_exists($imagePath)) {
                    $classroom->addMedia($imagePath)
                        ->preservingOriginal()
                        ->toMediaCollection('images');
                }
            }
        }

        $this->command->info('  ✓ Classrooms seeded');
    }

    private function seedNews($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        // News articles with relationships
        $news = [
            [
                'title' => [
                    'en' => "{$branchNames['en']} Students Excel in National Competition",
                    'ckb' => "قوتابیانی {$branchNames['ckb']} لە ڕکابەرییەکی نیشتمانی دا سەرکەوتوو دەبن",
                    'ar' => "طلاب {$branchNames['ar']} يتفوقون في المسابقة الوطنية",
                ],
                'content' => [
                    'en' => "We are proud to announce that our students at {$branchNames['en']} have achieved outstanding results in the National Science and Mathematics Competition. This remarkable achievement demonstrates the dedication of our students and the quality of education.",
                    'ckb' => "شانازی بەوە دەکەین کە ڕابگەیەنین قوتابیانەکانمان لە {$branchNames['ckb']} دا ئەنجامی نایاب لە ڕکابەریی نیشتمانی زانست و بیرکاری دا بەدەست هێناوە. ئەم دەستکەوتە سەرنجڕاکێشە بەڵگەیە لەسەر بەخشندەیی قوتابیانەکانمان و کوالیتی پەروەردە.",
                    'ar' => "يسعدنا أن نعلن أن طلابنا في {$branchNames['ar']} حققوا نتائج متميزة في مسابقة العلوم والرياضيات الوطنية. يوضح هذا الإنجاز الرائع تفاني طلابنا وجودة التعليم.",
                ],
                'category' => 'achievement',
                'hashtags' => ['excellence', 'science', 'achievement'],
                'order' => 1,
            ],
            [
                'title' => [
                    'en' => "New STEM Laboratory Opens at {$branchNames['en']}",
                    'ckb' => "تاقیگەی نوێی STEM لە {$branchNames['ckb']} دا دەکرێتەوە",
                    'ar' => "افتتاح مختبر STEM الجديد في {$branchNames['ar']}",
                ],
                'content' => [
                    'en' => "Our new STEM laboratory at {$branchNames['en']} is equipped with the latest technology and equipment to inspire the next generation of scientists and innovators. The facility includes advanced robotics, 3D printing, and programming stations.",
                    'ckb' => "تاقیگە نوێیەکەمان بۆ STEM لە {$branchNames['ckb']} دا چەکدار کراوە بە دوایین تەکنەلۆژیا و ئامێر بۆ ئیلهام بەخشین بە نەوەی داهاتووی زانایان و داهێنەران. ئامێرەکە ڕۆبۆتی پێشکەوتوو، چاپکردنی سێ ڕەهەندی و وێستگەکانی بەرنامەسازی لەخۆدەگرێت.",
                    'ar' => "مختبرنا الجديد لـ STEM في {$branchNames['ar']} مجهز بأحدث التقنيات والمعدات لإلهام الجيل القادم من العلماء والمبتكرين. يتضمن المرفق الروبوتات المتقدمة والطباعة ثلاثية الأبعاد ومحطات البرمجة.",
                ],
                'category' => 'facilities',
                'hashtags' => ['stem', 'innovation', 'education'],
                'order' => 2,
            ],
            [
                'title' => [
                    'en' => "Cultural Festival Celebrates Diversity at {$branchNames['en']}",
                    'ckb' => "فێستیڤاڵی کولتووری جۆراوجۆری لە {$branchNames['ckb']} دا ئاهەنگ دەگرێت",
                    'ar' => "المهرجان الثقافي يحتفل بالتنوع في {$branchNames['ar']}",
                ],
                'content' => [
                    'en' => "The {$branchNames['en']} Cultural Festival showcased the rich diversity of our student community through performances, art exhibitions, and traditional food. Students, parents, and staff came together to celebrate the various cultures represented at our school.",
                    'ckb' => "فێستیڤاڵی کولتووری {$branchNames['ckb']} جۆراوجۆری دەوڵەمەندی کۆمەڵگای قوتابیانمانی نیشان دا لە ڕێگەی نمایش، پێشانگای هونەری و خواردنی نەریتی. قوتابیان، دایک و باوک و ستاف پێکەوە کۆبوونەوە بۆ ئاهەنگ گرتنی کولتوورە جیاوازەکانی نوێنەراوە لە قوتابخانەکەمان.",
                    'ar' => "عرض مهرجان {$branchNames['ar']} الثقافي التنوع الغني لمجتمع طلابنا من خلال العروض والمعارض الفنية والطعام التقليدي. اجتمع الطلاب وأولياء الأمور والموظفون للاحتفال بالثقافات المختلفة الممثلة في مدرستنا.",
                ],
                'category' => 'events',
                'hashtags' => ['culture', 'diversity', 'community'],
                'order' => 3,
            ],
        ];

        foreach ($news as $item) {
            $category = $item['category'];
            $hashtags = $item['hashtags'];
            unset($item['category'], $item['hashtags']);

            // Get category ID from seeded categories
            $categoryId = isset($this->categories[$category]) ? $this->categories[$category]->id : null;

            $newsArticle = News::updateOrCreate(
                array_merge($item, [
                    'user_id' => $user->id, 
                    'branch_id' => $branch->id,
                    'news_category_id' => $categoryId
                ])
            );

            // Attach hashtags (many-to-many)
            $hashtagIds = [];
            foreach ($hashtags as $hashtagSlug) {
                if (isset($this->hashtags[$hashtagSlug])) {
                    $hashtagIds[] = $this->hashtags[$hashtagSlug]->id;
                    $this->hashtags[$hashtagSlug]->incrementUsage();
                }
            }
            $newsArticle->hashtags()->sync($hashtagIds);
        }

        $this->command->info('  ✓ News articles seeded');
    }

    private function seedGallery($user, $branch)
    {
        $branchNames = $branch->getTranslations('name');
        
        // Get gallery categories by slug
        $campusCategory = \App\Models\Pages\GalleryCategory::where('slug', 'campus-life')->first();
        $labCategory = \App\Models\Pages\GalleryCategory::where('slug', 'laboratories')->first();
        $eventCategory = \App\Models\Pages\GalleryCategory::where('slug', 'cultural-events')->first();

        $galleries = [
            // Campus Life Category (6 items)
            [
                'title' => ['en' => "{$branchNames['en']} Campus Tour", 'ckb' => "گەشتی کامپەسی {$branchNames['ckb']}", 'ar' => "جولة في حرم {$branchNames['ar']}"],
                'description' => ['en' => "Photos from our {$branchNames['en']} campus and facilities.", 'ckb' => "وێنەkan لە کامپەس و ئامێرەکانی {$branchNames['ckb']}.", 'ar' => "صور من حرم ومرافق {$branchNames['ar']}."],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Library & Reading Spaces', 'ckb' => 'کتێبخانە و شوێنی خوێندنەوە', 'ar' => 'المكتبة ومساحات القراءة'],
                'description' => ['en' => 'Our well-equipped library with thousands of books and quiet study areas.', 'ckb' => 'کتێبخانە باش چەکدار کراوەکەمان بە هەزاران کتێب و شوێنی خوێندنی بێدەنگ.', 'ar' => 'مكتبتنا المجهزة جيدًا بآلاف الكتب ومناطق الدراسة الهادئة.'],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Sports Facilities', 'ckb' => 'ئامێرەکانی وەرزش', 'ar' => 'المرافق الرياضية'],
                'description' => ['en' => 'Modern sports complex including basketball courts, football field, and indoor gym.', 'ckb' => 'کۆمپڵێکسی وەرزشی مۆدێرن کە گۆڕەپانی باسکێتبۆڵ، گۆڕەپانی تۆپی پێ و زۆنی ناوەوە لەخۆدەگرێت.', 'ar' => 'مجمع رياضي حديث يشمل ملاعب كرة السلة وملعب كرة القدم وصالة داخلية.'],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Cafeteria & Dining Hall', 'ckb' => 'کافتێریا و هۆڵی خواردن', 'ar' => 'الكافتيريا وقاعة الطعام'],
                'description' => ['en' => 'Spacious dining area serving healthy and nutritious meals for students and staff.', 'ckb' => 'ناوچەی خواردنی فراوان کە خۆراکی تەندرووست و خۆراکبەخش بۆ خوێندکاران و کارمەندان دابین دەکات.', 'ar' => 'منطقة طعام واسعة تقدم وجبات صحية ومغذية للطلاب والموظفين.'],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Student Common Areas', 'ckb' => 'شوێنە هاوبەشەکانی قوتابیان', 'ar' => 'المناطق المشتركة للطلاب'],
                'description' => ['en' => 'Comfortable spaces for students to relax, socialize, and collaborate between classes.', 'ckb' => 'شوێنە ئاسوودەکان بۆ قوتابیان بۆ حەساندنەوە، کۆمەڵایەتی کردن و هاوکاری کردن لە نێوان وانەکاندا.', 'ar' => 'مساحات مريحة للطلاب للاسترخاء والتواصل الاجتماعي والتعاون بين الفصول.'],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Outdoor Learning Spaces', 'ckb' => 'شوێنەکانی فێربوونی دەرەوە', 'ar' => 'مساحات التعلم الخارجية'],
                'description' => ['en' => 'Beautiful outdoor areas designed for interactive learning and nature exploration.', 'ckb' => 'ناوچە جوانەکانی دەرەوە کە دیزاین کراون بۆ فێربوونی کارلێک و گەڕان بە سروشتدا.', 'ar' => 'مناطق خارجية جميلة مصممة للتعلم التفاعلي واستكشاف الطبيعة.'],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 6,
                'is_active' => true,
            ],
            
            // Laboratories Category (6 items)
            [
                'title' => ['en' => 'STEM Lab Highlights', 'ckb' => 'هەڵسەنگاندنەکانی تاقیگەی STEM', 'ar' => 'معالم مختبر STEM'],
                'description' => ['en' => 'Snapshots of our STEM activities and student projects.', 'ckb' => 'وێنەکانی چالاکی STEM و پرۆژەی خوێندکاران.', 'ar' => 'لقطات من أنشطة STEM ومشاريع الطلاب.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Science Laboratory', 'ckb' => 'تاقیگەی زانست', 'ar' => 'مختبر العلوم'],
                'description' => ['en' => 'State-of-the-art science lab with modern equipment for physics, chemistry, and biology experiments.', 'ckb' => 'تاقیگەی زانستی مۆدێرن بە ئامێری مۆدێرن بۆ تاقیکردنەوەکانی فیزیک، کیمیا و بایۆلۆجی.', 'ar' => 'مختبر علوم حديث مزود بمعدات حديثة لتجارب الفيزياء والكيمياء والأحياء.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Computer Lab', 'ckb' => 'تاقیگەی کۆمپیوتەر', 'ar' => 'مختبر الحاسوب'],
                'description' => ['en' => '40 high-performance computers with latest software for programming and digital design.', 'ckb' => '٤٠ کۆمپیوتەری بەرزکارایی بە دوایین نەرمەڕەقاڵە بۆ بەرنامەسازی و دیزاینی دیجیتاڵ.', 'ar' => '40 جهاز كمبيوتر عالي الأداء مع أحدث البرامج للبرمجة والتصميم الرقمي.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Robotics Workshop', 'ckb' => 'وۆرکشۆپی ڕۆبۆتیک', 'ar' => 'ورشة الروبوتات'],
                'description' => ['en' => 'Dedicated space for robotics projects with 3D printers and electronic components.', 'ckb' => 'شوێنی تایبەتمەند بۆ پرۆژەی ڕۆبۆتیک بە چاپکەری ٣D و پێکهاتە ئەلیکترۆنییەکان.', 'ar' => 'مساحة مخصصة لمشاريع الروبوتات مع طابعات ثلاثية الأبعاد ومكونات إلكترونية.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 10,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Chemistry Lab', 'ckb' => 'تاقیگەی کیمیا', 'ar' => 'مختبر الكيمياء'],
                'description' => ['en' => 'Fully equipped chemistry laboratory with safety equipment and modern instruments.', 'ckb' => 'تاقیگەی کیمیای تەواو چەکدار کراو بە ئامێری سەلامەتی و ئامێری مۆدێرن.', 'ar' => 'مختبر كيمياء مجهز بالكامل بمعدات السلامة والأدوات الحديثة.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 11,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Biology Lab', 'ckb' => 'تاقیگەی بایۆلۆجی', 'ar' => 'مختبر الأحياء'],
                'description' => ['en' => 'Advanced biology lab with microscopes and specimens for hands-on learning.', 'ckb' => 'تاقیگەی بایۆلۆجی پێشکەوتوو بە میکرۆسکۆپ و نموونە بۆ فێربوونی دەستی.', 'ar' => 'مختبر أحياء متقدم مع مجاهر وعينات للتعلم العملي.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 12,
                'is_active' => true,
            ],
            
            // Cultural Events Category (6 items)
            [
                'title' => ['en' => 'Cultural Events', 'ckb' => 'ڕووداوە کەلتوورییەکان', 'ar' => 'الفعاليات الثقافية'],
                'description' => ['en' => 'Gallery from our cultural festival and student performances.', 'ckb' => 'گالەریی فێستیڤاڵە کەلتوورییەکان و پێشکەشکردنی خوێندکاران.', 'ar' => 'معرض من مهرجاننا الثقافي وعروض الطلاب.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 13,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Annual Sports Day', 'ckb' => 'ڕۆژی ساڵانەی وەرزش', 'ar' => 'اليوم الرياضي السنوي'],
                'description' => ['en' => 'Highlights from our annual sports competition with track and field events.', 'ckb' => 'هەڵسەنگاندنەکانی ڕکابەریی وەرزشی ساڵانەمان بە ڕووداوەکانی ڕێگا و گۆڕەپان.', 'ar' => 'أبرز الأحداث من مسابقتنا الرياضية السنوية مع فعاليات ألعاب القوى.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 14,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Graduation Ceremony', 'ckb' => 'بۆنەی دەرچوون', 'ar' => 'حفل التخرج'],
                'description' => ['en' => 'Photos from our graduation ceremony celebrating student achievements.', 'ckb' => 'وێنەکان لە بۆنەی دەرچوونمان کە دەستکەوتەکانی خوێندکاران ئاهەنگ دەگرێت.', 'ar' => 'صور من حفل التخرج الخاص بنا احتفالاً بإنجازات الطلاب.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 15,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Science Fair', 'ckb' => 'پانەی زانست', 'ar' => 'معرض العلوم'],
                'description' => ['en' => 'Student projects and experiments showcased at our annual science fair.', 'ckb' => 'پرۆژە و تاقیکردنەوەکانی خوێندکاران لە پانەی زانستی ساڵانەمان نیشان دراون.', 'ar' => 'مشاريع وتجارب الطلاب المعروضة في معرض العلوم السنوي.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 16,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Art Exhibition', 'ckb' => 'پێشانگای هونەری', 'ar' => 'معرض فني'],
                'description' => ['en' => 'Student artwork displayed in our annual art exhibition showcasing creativity.', 'ckb' => 'کارە هونەرییەکانی خوێندکاران لە پێشانگای هونەری ساڵانەمان نیشان دراون کە داهێنان نیشان دەدەن.', 'ar' => 'أعمال الطلاب الفنية المعروضة في معرضنا الفني السنوي الذي يعرض الإبداع.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 17,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Music Concert', 'ckb' => 'کۆنسێرتی مۆسیقا', 'ar' => 'حفل موسيقي'],
                'description' => ['en' => 'Memorable moments from our student orchestra and choir performances.', 'ckb' => 'ساتە یادەوەرییەکان لە پێشکەشکردنەکانی ئۆرکێسترا و کۆری خوێندکارانمان.', 'ar' => 'لحظات لا تُنسى من عروض أوركسترا الطلاب والجوقة.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 18,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $index => $g) {
            $gallery = Gallery::create(array_merge($g, [
                'user_id' => $user->id,
                'branch_id' => $branch->id,
            ]));
            
            // Add images to gallery items
            // Using placeholder images (1-8 cycling through available media images)
            $imageNumber = ($index % 8) + 1;
            $imagePath = public_path("img/media/{$imageNumber}.jpg");
            
            if (file_exists($imagePath)) {
                $gallery->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        }

        $this->command->info('  ✓ Gallery items seeded');
    }

    private function seedCalendarAcademic($user, $branch)
    {
        CalendarAcademic::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => 'The academic calendar outlines the core instructional activities, enrichment programs, and educational milestones throughout the school year. It encompasses regular classroom instruction, specialized learning sessions, and student-centered projects designed to foster holistic development.',
                'ckb' => 'ڕۆژژمێری ئەکادیمی چالاکییە فێرکارییە سەرەکییەکان، پڕۆگرامە دەوڵەمەندکەرەوەکان و خاڵە پەروەردەییەکان بەدرێژایی ساڵی خوێندن دەردەخات. ئەمە فێرکاری ئاسایی پۆل، دانیشتنە فێربوونە تایبەتەکان و پڕۆژە قوتابی-ناوەندەکان لەخۆدەگرێت کە بۆ پەرەپێدانی گشتگیر دیزاین کراون.',
                'ar' => 'يحدد التقويم الأكاديمي الأنشطة التعليمية الأساسية وبرامج الإثراء والإنجازات التعليمية على مدار العام الدراسي. ويشمل التدريس المنتظم في الفصول الدراسية وجلسات التعلم المتخصصة والمشاريع التي تركز على الطالب والمصممة لتعزيز التنمية الشاملة.',
            ],
            'activities' => [
                'en' => [
                    'Core subject instruction',
                    'Weekly enrichment programs (STEM, arts, languages)',
                    'Monthly themes (Science Day, Reading Month, etc.)',
                    'Project-based learning and exhibitions'
                ],
                'ckb' => [
                    'فێرکاری بابەتە سەرەکییەکان',
                    'پڕۆگرامە دەوڵەمەندکەرەوە هەفتانەیەکان (STEM، هونەر، زمان)',
                    'ڕووکارە مانگانەکان (ڕۆژی زانست، مانگی خوێندنەوە، هتد)',
                    'فێربوونی لەسەر بنەمای پڕۆژە و پێشانگاکان'
                ],
                'ar' => [
                    'تدريس المواد الأساسية',
                    'برامج إثراء أسبوعية (STEM، الفنون، اللغات)',
                    'موضوعات شهرية (يوم العلوم، شهر القراءة، إلخ)',
                    'التعلم القائم على المشاريع والمعارض'
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Calendar Academic seeded');
    }

    private function seedCalendarOfficial($user, $branch)
    {
        CalendarOfficial::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'description' => [
                'en' => 'Official holidays include national celebrations, religious observances, and culturally significant days recognized across the Kurdistan Region and Iraq. The school remains closed during these periods to honor our diverse cultural heritage.',
                'ckb' => 'پشووە فەرمییەکان ئاهەنگە نیشتیمانییەکان، ڕێزگرتنە ئایینییەکان و ڕۆژە کولتووری گرنگەکان لەخۆدەگرن کە لە هەرێمی کوردستان و عێراق ناسراون. قوتابخانە لەم ماوەیانەدا داخراوە بۆ ڕێزگرتن لە میراتە کولتووری جۆراوجۆرەکەمان.',
                'ar' => 'تشمل العطلات الرسمية الاحتفالات الوطنية والاحتفالات الدينية والأيام ذات الأهمية الثقافية المعترف بها في إقليم كردستان والعراق. تظل المدرسة مغلقة خلال هذه الفترات لتكريم تراثنا الثقافي المتنوع.',
            ],
            'holidays' => [
                'en' => [
                    "New Year's Day",
                    'Nowruz (Kurdish New Year)',
                    'Eid al-Fitr and Eid al-Adha',
                    'Independence & National Days',
                    "Teacher's Day"
                ],
                'ckb' => [
                    'ڕۆژی ساڵی نوێ',
                    'نەورۆز (ساڵی نوێی کوردی)',
                    'جەژنی ڕەمەزان و قوربان',
                    'ڕۆژە سەربەخۆیی و نیشتیمانییەکان',
                    'ڕۆژی مامۆستا'
                ],
                'ar' => [
                    'رأس السنة الجديدة',
                    'نوروز (السنة الكردية الجديدة)',
                    'عيد الفطر وعيد الأضحى',
                    'أيام الاستقلال والأعياد الوطنية',
                    'يوم المعلم'
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Calendar Official seeded');
    }

    private function seedCalendarImportant($user, $branch)
    {
        CalendarImportant::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id,
            'events' => [
                'en' => [
                    ['name' => 'Start School', 'date' => 'Early September'],
                    ['name' => 'Midterm Exams', 'date' => 'November & March'],
                    ['name' => 'Final Exams', 'date' => 'January & June'],
                    ['name' => 'Parent-Teacher Meetings', 'date' => 'Each Semester'],
                    ['name' => 'Science Fair', 'date' => 'April'],
                    ['name' => 'Graduation & Cultural Day', 'date' => 'May - June'],
                    ['name' => 'Summer Program', 'date' => 'July'],
                ],
                'ckb' => [
                    ['name' => 'دەستپێکی قوتابخانە', 'date' => 'سەرەتای ئەیلوول'],
                    ['name' => 'تاقیکردنەوەی ناوەڕاست', 'date' => 'تشرینی دووەم و ئازار'],
                    ['name' => 'تاقیکردنەوەی کۆتایی', 'date' => 'کانوونی دووەم و حوزەیران'],
                    ['name' => 'کۆبوونەوەی دایک-باوک و مامۆستایان', 'date' => 'هەر وەرزێک'],
                    ['name' => 'پانەی زانست', 'date' => 'نیسان'],
                    ['name' => 'ڕۆژی دەرچوون و کولتوور', 'date' => 'ئایار - حوزەیران'],
                    ['name' => 'پڕۆگرامی هاوین', 'date' => 'تەمموز'],
                ],
                'ar' => [
                    ['name' => 'بداية المدرسة', 'date' => 'أوائل سبتمبر'],
                    ['name' => 'امتحانات منتصف الفصل', 'date' => 'نوفمبر ومارس'],
                    ['name' => 'الامتحانات النهائية', 'date' => 'يناير ويونيو'],
                    ['name' => 'اجتماعات أولياء الأمور والمعلمين', 'date' => 'كل فصل دراسي'],
                    ['name' => 'معرض العلوم', 'date' => 'أبريل'],
                    ['name' => 'التخرج واليوم الثقافي', 'date' => 'مايو - يونيو'],
                    ['name' => 'البرنامج الصيفي', 'date' => 'يوليو'],
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('  ✓ Calendar Important seeded');
    }
}
