<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Pages\News;
use App\Models\Pages\Campus;
use App\Models\Pages\Classroom;
use App\Models\Pages\Gallery;
use App\Models\Pages\GalleryCategory;
use App\Models\Pages\NewsCategory;
use App\Models\Pages\Hashtag;

class OnetimeCommand extends Command
{
    protected $signature = 'app:onetime {method?}';

    protected $description = 'One time command';

    public function handle()
    {
        @ini_set('memory_limit', '-1');

        if ($this->argument('method')) {
            $this->{$this->argument('method')}();
            return;
        }

        $all_methods = get_class_methods($this);
        $cons_key = array_search('__construct', $all_methods);
        $my_methods = collect($all_methods)->filter(fn($method, $key) => $key < $cons_key && $method != 'handle')->reverse()->toArray();

        if (empty($my_methods)) {
            $this->error('No method found to run');
            return;
        }

        $method = $this->choice('Which method you want to run?', $my_methods);
        $this->{$method}();
        return;
    }

    public function clear_content()
    {
        $this->info('Clearing news, campuses, classrooms and galleries...');
        // Do not use DB transactions here — truncates are DDL and may commit implicitly.
        // Disable FK checks, perform truncates and media cleanup, then re-enable FK checks.
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            News::truncate();
            Campus::truncate();
            Classroom::truncate();
            Gallery::truncate();
            Hashtag::truncate();

            NewsCategory::truncate();
            GalleryCategory::truncate();

            // Remove pivot relations between news and hashtags
            DB::table('news_hashtag')->delete();

            DB::table('media')->whereIn('model_type', [
                News::class,
                Campus::class,
                Classroom::class,
                Gallery::class,
                Hashtag::class,
            ])->delete();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->info('Cleared news, campuses, classrooms and galleries.');
        } catch (\Exception $e) {
            // Ensure FK checks are re-enabled even on error
            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            } catch (\Throwable $_) {
            }
            $this->error('Failed to clear content: ' . $e->getMessage());
        }
    }
}
