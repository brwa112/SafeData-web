<?php

namespace Database\Seeders;

use App\Models\Pages\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting News Image Seeder...');

        // Get all news articles
        $newsArticles = News::all();

        if ($newsArticles->isEmpty()) {
            $this->command->error('No news articles found. Please run FrontendPagesSeeder first.');
            return;
        }

        // Path to news images
        $newsImagesPath = public_path('img/news');

        if (!File::exists($newsImagesPath)) {
            $this->command->error("News images directory not found at: {$newsImagesPath}");
            return;
        }

        // Get all image files from the news directory
        $imageFiles = File::files($newsImagesPath);

        if (empty($imageFiles)) {
            $this->command->error('No images found in the news directory.');
            return;
        }

        $this->command->info("Found {$newsArticles->count()} news articles and " . count($imageFiles) . " images.");

        // Attach images to news articles (cycle through available images)
        $imageIndex = 0;
        foreach ($newsArticles as $news) {
            // Skip if already has images
            if ($news->getMedia('images')->count() > 0) {
                $this->command->info("News #{$news->id} already has images, skipping...");
                continue;
            }

            // Get the current image (cycle through available images)
            $imageFile = $imageFiles[$imageIndex % count($imageFiles)];

            try {
                // Add media to the news article
                $news->addMedia($imageFile->getPathname())
                    ->preservingOriginal() // Keep the original file in public/img/news
                    ->toMediaCollection('images');

                $this->command->info("✓ Attached image to News #{$news->id}: {$news->title}");
            } catch (\Exception $e) {
                $this->command->error("Failed to attach image to News #{$news->id}: " . $e->getMessage());
            }

            $imageIndex++;
        }

        $this->command->info('✅ News images seeded successfully!');
    }
}
