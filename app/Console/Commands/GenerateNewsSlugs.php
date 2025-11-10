<?php

namespace App\Console\Commands;

use App\Models\Pages\News;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateNewsSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing news articles that don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for news articles...');

        $newsWithoutSlugs = News::whereNull('slug')->orWhere('slug', '')->get();

        if ($newsWithoutSlugs->isEmpty()) {
            $this->info('All news articles already have slugs!');
            return 0;
        }

        $bar = $this->output->createProgressBar(count($newsWithoutSlugs));
        $bar->start();

        foreach ($newsWithoutSlugs as $news) {
            $title = is_array($news->title) 
                ? ($news->title['en'] ?? $news->title[array_key_first($news->title)] ?? 'news')
                : $news->title;
            
            $slug = Str::slug($title);
            $originalSlug = $slug;
            $counter = 1;

            // Ensure slug is unique
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $news->slug = $slug;
            $news->save();

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Successfully generated slugs for {$newsWithoutSlugs->count()} news articles!");

        return 0;
    }
}
