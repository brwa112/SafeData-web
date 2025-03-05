<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportTranslations extends Command
{
    protected $signature = 'translations:export {--format=csv}';
    protected $description = 'Export all translations to CSV/Excel file';

    private $languages = ['en', 'ar', 'ckb'];
    // private $languages = ['en', 'ar',];
    private $translations = [];
    private $outputFile = 'translations_export';

    public function handle()
    {
        $format = $this->option('format');
        $this->info('Starting translation export...');

        // Get all translation files from resources/lang
        foreach ($this->languages as $lang) {
            $langPath = base_path("lang/$lang");

            if (!File::exists($langPath)) {
                $this->warn("Language path not found: $langPath");
                continue;
            }

            $files = File::allFiles($langPath);

            foreach ($files as $file) {
                $group = $file->getBasename('.php');
                $translations = include $file->getPathname();
                $this->processTranslations($translations, $group, $lang);
            }
        }

        $this->exportToFile($format);
        $this->info('Export completed successfully!');
    }

    private function processTranslations($translations, $group, $lang, $prefix = '')
    {
        foreach ($translations as $key => $value) {
            if (is_array($value)) {
                $this->processTranslations($value, $group, $lang, $prefix . $key . '.');
            } else {
                $fullKey = $group . '.' . $prefix . $key;
                if (!isset($this->translations[$fullKey])) {
                    $this->translations[$fullKey] = array_fill_keys($this->languages, '');
                }
                $this->translations[$fullKey][$lang] = $value;
            }
        }
    }

    private function exportToFile($format)
    {
        // Prepare header
        $header = ['Key'];
        foreach ($this->languages as $lang) {
            $header[] = strtoupper($lang);
        }

        // Open file for writing
        $filename = storage_path("app/{$this->outputFile}.{$format}");
        $handle = fopen($filename, 'w');

        // Write UTF-8 BOM for Excel compatibility
        fwrite($handle, "\xEF\xBB\xBF");

        // Write header
        fputcsv($handle, $header);

        // Write translations
        foreach ($this->translations as $key => $values) {
            $row = [$key];
            foreach ($this->languages as $lang) {
                $row[] = $values[$lang] ?? '';
            }
            fputcsv($handle, $row);
        }

        fclose($handle);
        $this->info("File exported to: $filename");
    }
}
