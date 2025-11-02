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
                    'en' => $branchNames['en'] ?? '',
                    'ckb' => $branchNames['ckb'] ?? '',
                    'ar' => $branchNames['ar'] ?? $branchNames['ckb'] ?? '',
                ],
                'content' => [
                    'en' => "The {$branchNames['en']} campus is located in a vibrant educational district, offering students access to modern classrooms, advanced science laboratories, sports facilities, and cultural centers.",
                    'ckb' => "کەمپی {$branchNames['ckb']} لە ناوچەیەکی پەروەردەیی گەشاوە جێگیرە، دەرفەتی بەکارهێنانی پۆلی مۆدێرن، تاقیگەی زانستی پێشکەوتوو، ئامێری وەرزشی و ناوەندە کولتووریەکان بۆ قوتابیان دابین دەکات.",
                    'ar' => "يقع حرم {$branchNames['ar']} في منطقة تعليمية نابضة بالحياة، ويوفر للطلاب الوصول إلى الفصول الدراسية الحديثة والمختبرات العلمية المتقدمة والمرافق الرياضية والمراكز الثقافية.",
                ],
                'views' => 0,
                'order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($campuses as $campus) {
            Campus::create(array_merge($campus, [
                'user_id' => $user->id,
                'branch_id' => $branch->id
            ]));
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
                ],
                'content' => [
                    'en' => '<p>Our state-of-the-art science laboratory is equipped with modern technology and equipment, providing students with hands-on experience in conducting experiments and research.</p><p>The laboratory includes microscopes, lab benches, safety equipment, and digital displays to support various scientific disciplines including physics, chemistry, and biology.</p>',
                    'ckb' => '<p>تاقیگە زانستیەکانمان بە تەکنەلۆژیای مۆدێرن و ئامێرەکانی پێشکەوتوو چەکدار کراوە، کە ئەزموونی مەشقی بۆ قوتابیان دابین دەکات لە ئەنجامدانی تاقیکردنەوە و توێژینەوەدا.</p><p>تاقیگەکە میکرۆسکۆپ، میزی تاقیگە، ئامێری پاراستن و پیشاندەری دیجیتاڵی تێدایە بۆ پشتگیریکردنی بوارە زانستییە جیاوازەکان وەک فیزیک، کیمیا و بایەلۆژی.</p>',
                ],
                'views' => 0,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Library & Resource Center',
                    'ckb' => 'کتێبخانە و سەنتەری سەرچاوەکان',
                ],
                'content' => [
                    'en' => '<p>Our comprehensive library offers over 10,000 books, digital resources, and dedicated study spaces for students. The library is designed to foster a love of reading and provide resources for academic research.</p><p>Features include quiet study rooms, computer access, and a wide selection of reference materials across all subjects.</p>',
                    'ckb' => '<p>کتێبخانە گشتگیرەکەمان زیاتر لە ١٠،٠٠٠ کتێب، سەرچاوەی دیجیتاڵ و شوێنی تایبەتی خوێندن بۆ قوتابیان دابین دەکات. کتێبخانەکە دیزاین کراوە بۆ پەروەردەکردنی خۆشەویستی خوێندنەوە و دابینکردنی سەرچاوەکان بۆ توێژینەوەی ئەکادیمی.</p><p>تایبەتمەندییەکان ژووری بێدەنگی خوێندن، دەستڕاگەیشتن بە کۆمپیوتەر و هەڵبژاردنێکی فراوانی مادەی سەرچاوە لە هەموو بابەتەکاندا دەگرێتەوە.</p>',
                ],
                'views' => 0,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Computer Laboratory',
                    'ckb' => 'تاقیگەی کۆمپیوتەر',
                ],
                'content' => [
                    'en' => '<p>Our modern computer laboratory is equipped with 40 high-performance computers, projectors, and coding software for programming classes.</p><p>Students have access to industry-standard development tools and software, preparing them for careers in technology and computer science.</p>',
                    'ckb' => '<p>تاقیگەی کۆمپیوتەری مۆدێرنەکەمان چەکدار کراوە بە ٤٠ کۆمپیوتەری بەرزکارایی، پرۆژێکتەر و نەرمەڕەقی کۆدنووسی بۆ وانەکانی بەرنامەسازی.</p><p>قوتابیان دەستڕاگەیشتنیان هەیە بە ئامرازەکانی پەرەپێدان و نەرمەڕەقی ستانداردی پیشەسازی، کە ئامادەیان دەکات بۆ کارەکان لە تەکنەلۆژیا و زانستی کۆمپیوتەردا.</p>',
                ],
                'views' => 0,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($classrooms as $classroomData) {
            Classroom::create(array_merge($classroomData, [
                'user_id' => $user->id,
                'branch_id' => $branch->id
            ]));
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
            [
                'title' => ['en' => "{$branchNames['en']} Campus Tour", 'ckb' => "گەشتی کامپەسی {$branchNames['ckb']}", 'ar' => "جولة في حرم {$branchNames['ar']}"],
                'description' => ['en' => "Photos from our {$branchNames['en']} campus and facilities.", 'ckb' => "وێنەkan لە کامپەس و ئامێرەکانی {$branchNames['ckb']}.", 'ar' => "صور من حرم ومرافق {$branchNames['ar']}."],
                'gallery_category_id' => $campusCategory?->id,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'STEM Lab Highlights', 'ckb' => 'هەڵسەنگاندنەکانی تاقیگەی STEM', 'ar' => 'معالم مختبر STEM'],
                'description' => ['en' => 'Snapshots of our STEM activities and student projects.', 'ckb' => 'وێنەکانی چالاکی STEM و پرۆژەی خوێندکاران.', 'ar' => 'لقطات من أنشطة STEM ومشاريع الطلاب.'],
                'gallery_category_id' => $labCategory?->id,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Cultural Events', 'ckb' => 'ڕووداوە کەلتوورییەکان', 'ar' => 'الفعاليات الثقافية'],
                'description' => ['en' => 'Gallery from our cultural festival and student performances.', 'ckb' => 'گالەریی فێستیڤاڵە کەلتوورییەکان و پێشکەشکردنی خوێندکاران.', 'ar' => 'معرض من مهرجاننا الثقافي وعروض الطلاب.'],
                'gallery_category_id' => $eventCategory?->id,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $g) {
            Gallery::create(array_merge($g, [
                'user_id' => $user->id,
                'branch_id' => $branch->id,
            ]));
        }

        $this->command->info('  ✓ Gallery items seeded');
    }
}
