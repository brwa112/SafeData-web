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
use App\Models\Pages\About\AboutMedia;
use App\Models\Pages\About\AboutTouch;
use App\Models\Pages\Academic\AcademicApproach;
use App\Models\Pages\Academic\AcademicChoose;
use App\Models\Pages\Admission\AdmissionPolicy;
use App\Models\Pages\AdmissionDocument;
use App\Models\Pages\CalendarEvent;
use App\Models\Pages\Campus;
use App\Models\Pages\Classroom;
use App\Models\Pages\News;
use App\Models\System\Users\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FrontendPagesSeeder extends Seeder
{
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

        $this->seedHomeHero($user);
        $this->seedHomeHistory($user);
        $this->seedHomeMessage($user);
        $this->seedHomeMission($user);
        $this->seedHomeKnow($user);
        
        $this->seedAboutAbout($user);
        $this->seedAboutMessage($user);
        $this->seedAboutMission($user);
        $this->seedAboutMedia($user);
        $this->seedAboutTouch($user);
        
        $this->seedAcademicApproach($user);
        $this->seedAcademicChoose($user);
        
        $this->seedAdmissionPolicy($user);
        $this->seedAdmissionDocuments($user);
        
        $this->seedCalendarEvents($user);
        $this->seedCampuses($user);
        $this->seedClassrooms($user);
        $this->seedNews($user);

        $this->command->info('Frontend pages seeded successfully!');
    }

    // HOME PAGE SEEDERS
    private function seedHomeHero($user)
    {
        HomeHero::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Kurd Genius Schools',
                'ckb' => 'قوتابخانەی کوردجینیس',
                'ar' => 'مدارس كورد جينيوس',
            ],
            'subtitle' => [
                'en' => 'Quality Education, Bright Future',
                'ckb' => 'پەروەردەی باش، داهاتووی گەشاوە',
                'ar' => 'تعليم جيد، مستقبل مشرق',
            ],
            'description' => [
                'en' => 'Empowering students to reach their full potential through excellence in education.',
                'ckb' => 'هاندانی خوێندکاران بۆ گەیشتن بە تەواوی توانای خۆیان لە ڕێگەی پەروەردەی باشەوە.',
                'ar' => 'تمكين الطلاب من الوصول إلى إمكاناتهم الكاملة من خلال التميز في التعليم.',
            ],
            'cta_text' => [
                'en' => 'Learn More',
                'ckb' => 'زیاتر بزانە',
                'ar' => 'اعرف المزيد',
            ],
            'cta_link' => '/about',
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Home hero seeded.');
    }

    private function seedHomeHistory($user)
    {
        HomeHistory::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Our History',
                'ckb' => 'مێژوومان',
                'ar' => 'تاريخنا',
            ],
            'subtitle' => [
                'en' => 'A Legacy of Excellence Since 2013',
                'ckb' => 'میراتێکی باشی لە ساڵی ٢٠١٣ەوە',
                'ar' => 'إرث من التميز منذ عام 2013',
            ],
            'description' => [
                'en' => 'Founded in 2013 by Maya Company, Kurd Genius School has grown to become one of the leading educational institutions in the Kurdistan Region.',
                'ckb' => 'قوتابخانەی کوردجینیس لە ساڵی ٢٠١٣دا لەلایەن کۆمپانیای مایاوە دامەزراوە و بووەتە یەکێک لە پێشەنگترین دامەزراوە پەروەردەییەکانی هەرێمی کوردستان.',
                'ar' => 'تأسست مدرسة كورد جينيوس في عام 2013 من قبل شركة مايا، وأصبحت واحدة من المؤسسات التعليمية الرائدة في إقليم كوردستان.',
            ],
            'statistics' => [
                ['label' => ['en' => 'Years of Excellence', 'ckb' => 'ساڵی باشی', 'ar' => 'سنوات من التميز'], 'value' => '12+'],
                ['label' => ['en' => 'Graduates', 'ckb' => 'دەرچووان', 'ar' => 'خريجون'], 'value' => '1000+'],
                ['label' => ['en' => 'Teachers', 'ckb' => 'مامۆستایان', 'ar' => 'معلمون'], 'value' => '100+'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Home history seeded.');
    }

    private function seedHomeMessage($user)
    {
        HomeMessage::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Principal\'s Message',
                'ckb' => 'پەیامی بەڕێوەبەر',
                'ar' => 'رسالة المدير',
            ],
            'subtitle' => [
                'en' => 'Welcome to Kurd Genius',
                'ckb' => 'بەخێربێن بۆ کوردجینیس',
                'ar' => 'مرحباً بكم في كورد جينيوس',
            ],
            'description' => [
                'en' => 'We are committed to providing high-quality education that nurtures intellectual curiosity, critical thinking, and personal growth.',
                'ckb' => 'ئێمە پابەندین بە دابینکردنی پەروەردەیەکی باش کە کنجکاوی زیرەکانە، بیرکردنەوەی ڕەخنەگرانە و گەشەی کەسی پەروەردە دەکات.',
                'ar' => 'نحن ملتزمون بتوفير تعليم عالي الجودة يغذي الفضول الفكري والتفكير النقدي والنمو الشخصي.',
            ],
            'author' => [
                'en' => 'Mrs. Sozan Abubakr Mawlud',
                'ckb' => 'خاتوو سۆزان ئەبووبەکر مەولوود',
                'ar' => 'السيدة سوزان أبوبكر مولود',
            ],
            'author_position' => [
                'en' => 'Principal',
                'ckb' => 'بەڕێوەبەر',
                'ar' => 'مديرة',
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Home message seeded.');
    }

    private function seedHomeMission($user)
    {
        HomeMission::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Our Mission',
                'ckb' => 'ئامانجمان',
                'ar' => 'مهمتنا',
            ],
            'subtitle' => [
                'en' => 'Excellence in Education',
                'ckb' => 'باشی لە پەروەردەدا',
                'ar' => 'التميز في التعليم',
            ],
            'description' => [
                'en' => 'To deliver excellence in education through innovative teaching methods, a supportive learning environment, and a curriculum that balances academic achievement with character development.',
                'ckb' => 'گەیاندنی باشی لە پەروەردەدا لە ڕێگەی شێوازە نوێیەکانی وانەوتنەوە، ژینگەیەکی پشتیوانی فێربوون و مەنهەجێک کە هاوسەنگی لە نێوان دەستکەوتی ئەکادیمی و گەشەپێدانی کەسایەتیدا دروست دەکات.',
                'ar' => 'تقديم التميز في التعليم من خلال أساليب تدريس مبتكرة وبيئة تعليمية داعمة ومنهج دراسي يوازن بين الإنجاز الأكاديمي وتنمية الشخصية.',
            ],
            'values' => [
                ['en' => 'Academic Excellence', 'ckb' => 'باشی ئەکادیمی', 'ar' => 'التميز الأكاديمي'],
                ['en' => 'Character Building', 'ckb' => 'دروستکردنی کەسایەتی', 'ar' => 'بناء الشخصية'],
                ['en' => 'Innovation', 'ckb' => 'داهێنان', 'ar' => 'الابتكار'],
                ['en' => 'Community', 'ckb' => 'کۆمەڵگا', 'ar' => 'المجتمع'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Home mission seeded.');
    }

    private function seedHomeKnow($user)
    {
        HomeKnow::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Get to Know Us',
                'ckb' => 'بمانناسە',
                'ar' => 'تعرف علينا',
            ],
            'subtitle' => [
                'en' => 'Why Choose Kurd Genius',
                'ckb' => 'بۆچی کوردجینیس هەڵبژێریت',
                'ar' => 'لماذا تختار كورد جينيوس',
            ],
            'description' => [
                'en' => 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths.',
                'ckb' => 'ئێمە باوەڕمان وایە هەر خوێندکارێک تایبەتە. بۆیە ڕێژەی کەمی خوێندکار بۆ مامۆستا ڕێگە بە سەرنج و ڕێگای فێربوونی تایبەتمەند دەدات.',
                'ar' => 'نحن نؤمن بأن كل طالب فريد من نوعه. لهذا السبب تسمح نسبة الطلاب إلى المعلمين المنخفضة لدينا بالاهتمام الشخصي ومسارات التعلم المخصصة.',
            ],
            'features' => [
                ['en' => 'Experienced Teachers', 'ckb' => 'مامۆستایانی شارەزا', 'ar' => 'معلمون ذوو خبرة'],
                ['en' => 'Modern Facilities', 'ckb' => 'کەرەستەی سەردەم', 'ar' => 'مرافق حديثة'],
                ['en' => 'Small Class Sizes', 'ckb' => 'قەبارەی پۆلی بچووک', 'ar' => 'أحجام صفوف صغيرة'],
                ['en' => 'University Preparation', 'ckb' => 'ئامادەکاری بۆ زانکۆ', 'ar' => 'التحضير للجامعة'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Home know seeded.');
    }

    // ABOUT PAGE SEEDERS
    private function seedAboutAbout($user)
    {
        AboutAbout::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'About Kurd Genius School',
                'ckb' => 'دەربارەی قوتابخانەی کوردجینیس',
                'ar' => 'حول مدرسة كورد جينيوس',
            ],
            'subtitle' => [
                'en' => 'Excellence in Education Since 2013',
                'ckb' => 'باشی لە پەروەردەدا لە ساڵی ٢٠١٣ەوە',
                'ar' => 'التميز في التعليم منذ عام 2013',
            ],
            'description' => [
                'en' => 'Kurd Genius School was established in 2013 by Maya Company, a proud member of the Qaiwan Group of Companies, and is led by Mrs. Sozan Abubakr Mawlud. Since its foundation, the school has consistently ranked among the top performing educational institutions in the Kurdistan Region.',
                'ckb' => 'قوتابخانەی کوردجینیس لە ساڵی ٢٠١٣دا لەلایەن کۆمپانیای مایاوە دامەزراوە، ئەندامێکی شانازی دەرەوەی کۆمپانیاکانی قەیوانە، و لەلایەن خاتوو سۆزان ئەبووبەکر مەولوودەوە بەڕێوە دەبرێت.',
                'ar' => 'تأسست مدرسة كورد جينيوس في عام 2013 من قبل شركة مايا، وهي عضو فخور في مجموعة قيوان للشركات، وتديرها السيدة سوزان أبوبكر مولود.',
            ],
            'established_year' => 2013,
            'founder' => [
                'en' => 'Maya Company / Qaiwan Group',
                'ckb' => 'کۆمپانیای مایا / گروپی قەیوان',
                'ar' => 'شركة مايا / مجموعة قيوان',
            ],
            'achievements' => [
                ['en' => 'Top ranking institution in Kurdistan Region', 'ckb' => 'دامەزراوەی پلەی یەکەم لە هەرێمی کوردستان', 'ar' => 'مؤسسة الترتيب الأول في إقليم كوردستان'],
                ['en' => 'Annual recognition from Ministry of Education', 'ckb' => 'ناسینەوەی ساڵانە لە وەزارەتی پەروەردەوە', 'ar' => 'اعتراف سنوي من وزارة التربية'],
                ['en' => '1000+ successful graduates', 'ckb' => '١٠٠٠+ دەرچووی سەرکەوتوو', 'ar' => '1000+ خريج ناجح'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('About about seeded.');
    }

    private function seedAboutMessage($user)
    {
        AboutMessage::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Our Message',
                'ckb' => 'پەیامەکەمان',
                'ar' => 'رسالتنا',
            ],
            'subtitle' => [
                'en' => 'Building Tomorrow\'s Leaders',
                'ckb' => 'بنیاتنانی سەرکردەکانی سبەی',
                'ar' => 'بناء قادة الغد',
            ],
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
            'author_position' => [
                'en' => 'Founder & Principal',
                'ckb' => 'دامەزرێنەر و بەڕێوەبەر',
                'ar' => 'المؤسس والمدير',
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('About message seeded.');
    }

    private function seedAboutMission($user)
    {
        AboutMission::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Our Mission',
                'ckb' => 'ئامانجمان',
                'ar' => 'مهمتنا',
            ],
            'subtitle' => [
                'en' => 'Excellence Through Innovation',
                'ckb' => 'باشی لە ڕێگەی داهێنانەوە',
                'ar' => 'التميز من خلال الابتكار',
            ],
            'description' => [
                'en' => 'To deliver excellence in education through innovative teaching methods, a supportive learning environment, and a curriculum that balances academic achievement with character development.',
                'ckb' => 'گەیاندنی باشی لە پەروەردەدا لە ڕێگەی شێوازە نوێیەکانی وانەوتنەوە و ژینگەیەکی پشتیوانی فێربوون.',
                'ar' => 'تقديم التميز في التعليم من خلال أساليب تدريس مبتكرة وبيئة تعليمية داعمة.',
            ],
            'goals' => [
                ['en' => 'Foster critical thinking and creativity', 'ckb' => 'پەروەردەکردنی بیرکردنەوەی ڕەخنەگرانە و داهێنان', 'ar' => 'تعزيز التفكير النقدي والإبداع'],
                ['en' => 'Develop strong academic foundation', 'ckb' => 'گەشەپێدانی بنەمای ئەکادیمی بەهێز', 'ar' => 'تطوير أساس أكاديمي قوي'],
                ['en' => 'Build character and values', 'ckb' => 'بنیاتنانی کەسایەتی و بەهاکان', 'ar' => 'بناء الشخصية والقيم'],
                ['en' => 'Prepare for global citizenship', 'ckb' => 'ئامادەکاری بۆ هاووڵاتیبوونی جیهانی', 'ar' => 'الاستعداد للمواطنة العالمية'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('About mission seeded.');
    }

    private function seedAboutMedia($user)
    {
        AboutMedia::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Our Campus',
                'ckb' => 'کامپەسەکەمان',
                'ar' => 'حرمنا الجامعي',
            ],
            'description' => [
                'en' => 'Take a virtual tour of our state-of-the-art facilities and vibrant learning environment.',
                'ckb' => 'گەشتێکی مەجازی بکە بۆ کەرەستە سەردەمەکانمان و ژینگەی فێربوونی چالاک.',
                'ar' => 'قم بجولة افتراضية في مرافقنا الحديثة وبيئة التعلم النابضة بالحياة.',
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('About media seeded.');
    }

    private function seedAboutTouch($user)
    {
        AboutTouch::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Get in Touch',
                'ckb' => 'پەیوەندیمان پێوە بکە',
                'ar' => 'تواصل معنا',
            ],
            'subtitle' => [
                'en' => 'We\'d Love to Hear From You',
                'ckb' => 'خۆشحاڵ دەبین لە بیستنی دەنگت',
                'ar' => 'نحن نحب أن نسمع منك',
            ],
            'description' => [
                'en' => 'Contact us for admissions, inquiries, or to schedule a campus visit.',
                'ckb' => 'پەیوەندیمان پێوە بکە بۆ وەرگرتن، پرسیار یان دیاریکردنی کاتی سەردانی کامپەس.',
                'ar' => 'اتصل بنا للقبول أو الاستفسارات أو لجدولة زيارة للحرم الجامعي.',
            ],
            'contact_email' => 'kurdgeniusschool@gmail.com',
            'contact_phone' => '+964 770 342 0606',
            'contact_address' => [
                'en' => 'Main Street, Educational District, Erbil, Kurdistan Region',
                'ckb' => 'شەقامی سەرەکی، دەڤەری پەروەردە، هەولێر، هەرێمی کوردستان',
                'ar' => 'الشارع الرئيسي، المنطقة التعليمية، أربيل، إقليم كوردستان',
            ],
            'social_links' => [
                'facebook' => 'https://facebook.com/kurdgenius',
                'instagram' => 'https://instagram.com/kurdgenius',
                'twitter' => 'https://twitter.com/kurdgenius',
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('About touch seeded.');
    }

    // ACADEMIC PAGE SEEDERS
    private function seedAcademicApproach($user)
    {
        AcademicApproach::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Our Educational Approach',
                'ckb' => 'ڕێبازی پەروەردەییمان',
                'ar' => 'نهجنا التعليمي',
            ],
            'subtitle' => [
                'en' => 'Student-Centered Learning',
                'ckb' => 'فێربوونی سەنتەری خوێندکار',
                'ar' => 'التعلم المتمحور حول الطالب',
            ],
            'description' => [
                'en' => 'We believe in fostering a learning environment where students are active participants in their education. Our approach combines traditional wisdom with modern pedagogical methods.',
                'ckb' => 'ئێمە باوەڕمان بە پەروەردەکردنی ژینگەیەکی فێربوونە کە خوێندکاران بەشداربووی چالاکن لە پەروەردەکەیاندا.',
                'ar' => 'نحن نؤمن بتعزيز بيئة تعليمية حيث يكون الطلاب مشاركين نشطين في تعليمهم.',
            ],
            'features' => [
                ['en' => 'Personalized Learning Plans', 'ckb' => 'پلانی فێربوونی تایبەتمەند', 'ar' => 'خطط تعليمية مخصصة'],
                ['en' => 'Interactive Classrooms', 'ckb' => 'پۆلە کارلێکەرەکان', 'ar' => 'فصول دراسية تفاعلية'],
                ['en' => 'Project-Based Learning', 'ckb' => 'فێربوونی بنەما لەسەر پرۆژە', 'ar' => 'التعلم القائم على المشاريع'],
                ['en' => 'Critical Thinking Development', 'ckb' => 'گەشەپێدانی بیرکردنەوەی ڕەخنەگرانە', 'ar' => 'تطوير التفكير النقدي'],
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
            'title' => [
                'en' => 'Why Choose Kurd Genius?',
                'ckb' => 'بۆچی کوردجینیس هەڵبژێریت؟',
                'ar' => 'لماذا تختار كورد جينيوس؟',
            ],
            'subtitle' => [
                'en' => 'Excellence in Education',
                'ckb' => 'باشی لە پەروەردەدا',
                'ar' => 'التميز في التعليم',
            ],
            'description' => [
                'en' => 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths — ensuring academic success and emotional growth.',
                'ckb' => 'ئێمە باوەڕمان وایە هەر خوێندکارێک تایبەتە. بۆیە ڕێژەی کەمی خوێندکار بۆ مامۆستا ڕێگە بە سەرنج و ڕێگای فێربوونی تایبەتمەند دەدات.',
                'ar' => 'نحن نؤمن بأن كل طالب فريد من نوعه. لهذا السبب تسمح نسبة الطلاب إلى المعلمين المنخفضة لدينا بالاهتمام الشخصي ومسارات التعلم المخصصة.',
            ],
            'reasons' => [
                ['en' => 'Top-ranked educational institution', 'ckb' => 'دامەزراوەی پەروەردەی پلەی یەکەم', 'ar' => 'مؤسسة تعليمية من الدرجة الأولى'],
                ['en' => 'Experienced and qualified teachers', 'ckb' => 'مامۆستایانی شارەزا و شایستە', 'ar' => 'معلمون ذوو خبرة ومؤهلون'],
                ['en' => 'State-of-the-art facilities', 'ckb' => 'کەرەستەی سەردەم', 'ar' => 'مرافق حديثة'],
                ['en' => 'Strong university placement record', 'ckb' => 'تۆمارێکی بەهێزی دانانی زانکۆ', 'ar' => 'سجل قوي في القبول الجامعي'],
                ['en' => 'Rich extracurricular programs', 'ckb' => 'بەرنامە دەرەکییە دەوڵەمەندەکان', 'ar' => 'برامج غنية خارج المنهج'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Academic choose seeded.');
    }

    // ADMISSION PAGE SEEDERS
    private function seedAdmissionPolicy($user)
    {
        AdmissionPolicy::create([
            'user_id' => $user->id,
            'title' => [
                'en' => 'Admission Policy',
                'ckb' => 'سیاسەتی وەرگرتن',
                'ar' => 'سياسة القبول',
            ],
            'subtitle' => [
                'en' => 'Fair and Transparent Process',
                'ckb' => 'پرۆسەیەکی دادپەروەرانە و ڕوون',
                'ar' => 'عملية عادلة وشفافة',
            ],
            'description' => [
                'en' => 'Kurd Genius School maintains a fair and transparent admission process. We welcome students from diverse backgrounds who demonstrate a genuine interest in learning and personal growth.',
                'ckb' => 'قوتابخانەی کوردجینیس پرۆسەیەکی دادپەروەرانە و ڕوونی وەرگرتنی هەیە. ئێمە پێشوازی لە خوێندکاران دەکەین لە پاشخانە جیاوازەکانەوە.',
                'ar' => 'تحافظ مدرسة كورد جينيوس على عملية قبول عادلة وشفافة. نرحب بالطلاب من خلفيات متنوعة.',
            ],
            'requirements' => [
                ['en' => 'Birth certificate or national ID', 'ckb' => 'بڕوانامەی لەدایکبوون یان ناسنامەی نیشتمانی', 'ar' => 'شهادة الميلاد أو الهوية الوطنية'],
                ['en' => 'Previous academic records', 'ckb' => 'تۆمارە ئەکادیمیەکانی پێشوو', 'ar' => 'السجلات الأكاديمية السابقة'],
                ['en' => 'Medical examination certificate', 'ckb' => 'بڕوانامەی پشکنینی پزیشکی', 'ar' => 'شهادة الفحص الطبي'],
                ['en' => 'Parent/Guardian information', 'ckb' => 'زانیاری دایک/باوک یان چاودێر', 'ar' => 'معلومات ولي الأمر'],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Admission policy seeded.');
    }

    private function seedAdmissionDocuments($user)
    {
        $documents = [
            [
                'title' => 'Birth Certificate',
                'description' => 'Official birth certificate or national ID',
                'document_type' => 'pdf',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'title' => 'Previous School Records',
                'description' => 'Academic transcripts from previous school',
                'document_type' => 'pdf',
                'is_required' => true,
                'order' => 2,
            ],
            [
                'title' => 'Medical Certificate',
                'description' => 'Recent medical examination certificate',
                'document_type' => 'pdf',
                'is_required' => true,
                'order' => 3,
            ],
            [
                'title' => 'Passport Photos',
                'description' => '4 recent passport-sized photographs',
                'document_type' => 'image',
                'is_required' => true,
                'order' => 4,
            ],
        ];

        foreach ($documents as $document) {
            AdmissionDocument::create(array_merge($document, ['user_id' => $user->id]));
        }

        $this->command->info('Admission documents seeded.');
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

    private function seedCampuses($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::where('slug', 'kurd-genius')->first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping campuses seeding.');
            return;
        }

        $campuses = [
            [
                'title' => [
                    'en' => 'Kurd Genius Educational Communities',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کورد جینیۆس',
                    'ar' => 'المجتمعات التعليمية لكرد جينيوس',
                ],
                'content' => [
                    'en' => 'The main Kurd Genius campus is located in a vibrant educational district, offering students access to modern classrooms, advanced science laboratories, sports facilities, and cultural centers.',
                    'ckb' => 'کەمپی سەرەکی کورد جینیۆس لە ناوچەیەکی پەروەردەیی گەشاوە جێگیرە، دەرفەتی بەکارهێنانی پۆلی مۆدێرن، تاقیگەی زانستی پێشکەوتوو، ئامێری وەرزشی و ناوەندە کولتووریەکان بۆ قوتابیان دابین دەکات.',
                    'ar' => 'يقع الحرم الرئيسي لكرد جينيوس في منطقة تعليمية نابضة بالحياة، ويوفر للطلاب الوصول إلى الفصول الدراسية الحديثة والمختبرات العلمية المتقدمة والمرافق الرياضية والمراكز الثقافية.',
                ],
                'views' => 0,
                'order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($campuses as $campus) {
            Campus::create(array_merge($campus, [
                'user_id' => $user->id,
                'branch_id' => $defaultBranch->id
            ]));
        }

        $this->command->info('Campuses seeded.');
    }

    private function seedClassrooms($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::where('slug', 'kurd-genius')->first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping classrooms seeding.');
            return;
        }

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
                'branch_id' => $defaultBranch->id
            ]));
        }

        $this->command->info('Classrooms seeded.');
    }

    private function seedNews($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::where('slug', 'kurd-genius')->first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping news seeding.');
            return;
        }

        // First, seed categories
        $categories = [
            [
                'name' => ['en' => 'Achievement', 'ckb' => 'دەستکەوت', 'ar' => 'إنجاز'],
                'slug' => 'achievement',
                'description' => ['en' => 'Student and school achievements', 'ckb' => 'دەستکەوتەکانی قوتابیان و قوتابخانە', 'ar' => 'إنجازات الطلاب والمدرسة'],
                'order' => 1,
            ],
            [
                'name' => ['en' => 'Facilities', 'ckb' => 'ئامێرەکان', 'ar' => 'المرافق'],
                'slug' => 'facilities',
                'description' => ['en' => 'School facilities and infrastructure', 'ckb' => 'ئامێرەکان و ژێرخانی قوتابخانە', 'ar' => 'مرافق وبنية تحتية للمدرسة'],
                'order' => 2,
            ],
            [
                'name' => ['en' => 'Events', 'ckb' => 'بۆنەکان', 'ar' => 'الفعاليات'],
                'slug' => 'events',
                'description' => ['en' => 'School events and activities', 'ckb' => 'بۆنە و چالاکییەکانی قوتابخانە', 'ar' => 'فعاليات وأنشطة المدرسة'],
                'order' => 3,
            ],
        ];

        $categoryModels = [];
        foreach ($categories as $category) {
            $categoryModels[$category['slug']] = \App\Models\Pages\Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Second, seed hashtags
        $hashtags = [
            [
                'name' => ['en' => 'Excellence', 'ckb' => 'باشی', 'ar' => 'التميز'],
                'slug' => 'excellence',
            ],
            [
                'name' => ['en' => 'Science', 'ckb' => 'زانست', 'ar' => 'العلوم'],
                'slug' => 'science',
            ],
            [
                'name' => ['en' => 'Achievement', 'ckb' => 'دەستکەوت', 'ar' => 'الإنجاز'],
                'slug' => 'achievement',
            ],
            [
                'name' => ['en' => 'STEM', 'ckb' => 'STEM', 'ar' => 'STEM'],
                'slug' => 'stem',
            ],
            [
                'name' => ['en' => 'Innovation', 'ckb' => 'داهێنان', 'ar' => 'الابتكار'],
                'slug' => 'innovation',
            ],
            [
                'name' => ['en' => 'Education', 'ckb' => 'پەروەردە', 'ar' => 'التعليم'],
                'slug' => 'education',
            ],
            [
                'name' => ['en' => 'Culture', 'ckb' => 'کولتوور', 'ar' => 'الثقافة'],
                'slug' => 'culture',
            ],
            [
                'name' => ['en' => 'Diversity', 'ckb' => 'جۆراوجۆری', 'ar' => 'التنوع'],
                'slug' => 'diversity',
            ],
            [
                'name' => ['en' => 'Community', 'ckb' => 'کۆمەڵگا', 'ar' => 'المجتمع'],
                'slug' => 'community',
            ],
        ];

        $hashtagModels = [];
        foreach ($hashtags as $hashtag) {
            $hashtagModels[$hashtag['slug']] = \App\Models\Pages\Hashtag::updateOrCreate(
                ['slug' => $hashtag['slug']],
                $hashtag
            );
        }

        // Now seed news with relationships
        $news = [
            [
                'title' => [
                    'en' => 'Kurd Genius Students Excel in National Competition',
                    'ckb' => 'قوتابیانی کورد جینیۆس لە ڕکابەرییەکی نیشتمانی دا سەرکەوتوو دەبن',
                    'ar' => 'طلاب كرد جينيوس يتفوقون في المسابقة الوطنية',
                ],
                'content' => [
                    'en' => 'We are proud to announce that our students have achieved outstanding results in the National Science and Mathematics Competition. This remarkable achievement demonstrates the dedication of our students and the quality of education at Kurd Genius.',
                    'ckb' => 'شانازی بەوە دەکەین کە ڕابگەیەنین قوتابیانەکانمان ئەنجامی نایاب لە ڕکابەریی نیشتمانی زانست و بیرکاری دا بەدەست هێناوە. ئەم دەستکەوتە سەرنجڕاکێشە بەڵگەیە لەسەر بەخشندەیی قوتابیانەکانمان و کوالیتی پەروەردە لە کورد جینیۆس.',
                    'ar' => 'يسعدنا أن نعلن أن طلابنا حققوا نتائج متميزة في مسابقة العلوم والرياضيات الوطنية. يوضح هذا الإنجاز الرائع تفاني طلابنا وجودة التعليم في كرد جينيوس.',
                ],
                'category' => 'achievement',
                'hashtags' => ['excellence', 'science', 'achievement'],
                'order' => 1,
            ],
            [
                'title' => [
                    'en' => 'New STEM Laboratory Opens at Kurd Genius',
                    'ckb' => 'تاقیگەی نوێی STEM لە کورد جینیۆس دا دەکرێتەوە',
                    'ar' => 'افتتاح مختبر STEM الجديد في كرد جينيوس',
                ],
                'content' => [
                    'en' => 'Our new STEM laboratory is equipped with the latest technology and equipment to inspire the next generation of scientists and innovators. The facility includes advanced robotics, 3D printing, and programming stations.',
                    'ckb' => 'تاقیگە نوێیەکەمان بۆ STEM چەکدار کراوە بە دوایین تەکنەلۆژیا و ئامێر بۆ ئیلهام بەخشین بە نەوەی داهاتووی زانایان و داهێنەران. ئامێرەکە ڕۆبۆتی پێشکەوتوو، چاپکردنی سێ ڕەهەندی و وێستگەکانی بەرنامەسازی لەخۆدەگرێت.',
                    'ar' => 'مختبرنا الجديد لـ STEM مجهز بأحدث التقنيات والمعدات لإلهام الجيل القادم من العلماء والمبتكرين. يتضمن المرفق الروبوتات المتقدمة والطباعة ثلاثية الأبعاد ومحطات البرمجة.',
                ],
                'category' => 'facilities',
                'hashtags' => ['stem', 'innovation', 'education'],
                'order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Cultural Festival Celebrates Diversity at Kurd Genius',
                    'ckb' => 'فێستیڤاڵی کولتووری جۆراوجۆری لە کورد جینیۆس دا ئاهەنگ دەگرێت',
                    'ar' => 'المهرجان الثقافي يحتفل بالتنوع في كرد جينيوس',
                ],
                'content' => [
                    'en' => 'The Kurd Genius Cultural Festival showcased the rich diversity of our student community through performances, art exhibitions, and traditional food. Students, parents, and staff came together to celebrate the various cultures represented at our school.',
                    'ckb' => 'فێستیڤاڵی کولتووری کورد جینیۆس جۆراوجۆری دەوڵەمەندی کۆمەڵگای قوتابیانمانی نیشان دا لە ڕێگەی نمایش، پێشانگای هونەری و خواردنی نەریتی. قوتابیان، دایک و باوک و ستاف پێکەوە کۆبوونەوە بۆ ئاهەنگ گرتنی کولتوورە جیاوازەکانی نوێنەراوە لە قوتابخانەکەمان.',
                    'ar' => 'عرض مهرجان كرد جينيوس الثقافي التنوع الغني لمجتمع طلابنا من خلال العروض والمعارض الفنية والطعام التقليدي. اجتمع الطلاب وأولياء الأمور والموظفون للاحتفال بالثقافات المختلفة الممثلة في مدرستنا.',
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

            // Get category ID
            $categoryId = isset($categoryModels[$category]) ? $categoryModels[$category]->id : null;

            $newsArticle = News::updateOrCreate(
                array_merge($item, [
                    'user_id' => $user->id, 
                    'branch_id' => $defaultBranch->id,
                    'category_id' => $categoryId
                ])
            );

            // Attach hashtags (many-to-many)
            $hashtagIds = [];
            foreach ($hashtags as $hashtagSlug) {
                if (isset($hashtagModels[$hashtagSlug])) {
                    $hashtagIds[] = $hashtagModels[$hashtagSlug]->id;
                    $hashtagModels[$hashtagSlug]->incrementUsage();
                }
            }
            $newsArticle->hashtags()->sync($hashtagIds);
        }

        $this->command->info('News articles seeded.');
    }
}
