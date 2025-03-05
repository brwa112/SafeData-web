<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

class SyncTranslations extends Command
{
    protected $signature = 'translations:sync';

    protected $description = 'Sync missing translations in other languages recursively';

    public function handle()
    {
        ini_set('memory_limit', '512M');

        $this->info('Syncing translations...');

        // get languages files from the source language which is english
        $sourceLanguage = 'en';

        // get all the available languages from lang directory and ignore the source language
        $languages = array_map('basename', File::directories(resource_path('../lang')));

        // ignore the source language from the list
        $languages = array_diff($languages, [$sourceLanguage]);

        // get all the language files from the lang directory for the source language
        $sourceLanguageFiles = glob(resource_path("../lang/{$sourceLanguage}/*.php"));

        // sync the source language files with other languages if they are missing
        foreach ($sourceLanguageFiles as $sourceLanguageFile) {
            $fileName = basename($sourceLanguageFile, '.php');

            foreach ($languages as $language) {
                $filePath = resource_path("../lang/{$language}/{$fileName}.php");

                if (!File::exists($filePath)) {
                    $content = include(resource_path("../lang/{$sourceLanguage}/{$fileName}.php"));
                    File::put($filePath, "<?php\n\nreturn " . $this->var_export($content, true) . ';');
                }
            }
        }

        // get all the language files from the source lang directory and compare them with other languages and sync them if they are missing in other languages recursively without overwriting the existing translations
        $sourceLanguageFiles = glob(resource_path("../lang/{$sourceLanguage}/*.php"));

        foreach ($sourceLanguageFiles as $sourceLanguageFile) {
            $fileName = basename($sourceLanguageFile, '.php');

            foreach ($languages as $language) {
                $filePath = resource_path("../lang/{$language}/{$fileName}.php");

                if (File::exists($filePath)) {
                    $sourceContent = include(resource_path("../lang/{$sourceLanguage}/{$fileName}.php"));
                    $targetContent = include(resource_path("../lang/{$language}/{$fileName}.php"));

                    foreach ($sourceContent as $key => $value) {
                        if (is_array($value)) {
                            $targetContent[$key] =  ($targetContent[$key] ?? []) +  array_diff_key($sourceContent[$key] ?? [], $targetContent[$key] ?? []);
                        }
                    }

                    // get the missing keys in the target language file
                    $missingKeys = array_diff_key($sourceContent, $targetContent);

                    // add the missing keys to the target language file
                    $targetContent = $targetContent + $missingKeys;



                    // sort the array by key
                    //ksort($targetContent);

                    // write the content to the target language file
                    File::put($filePath, "<?php\n\nreturn " . $this->var_export($targetContent, true) . ';');
                }
            }
        }




        $this->info('Translations sync complete.');
    }

    function var_export($expression, $return = FALSE)
    {
        if (!is_array($expression)) return var_export($expression, $return);
        $export = var_export($expression, TRUE);
        $export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
        $array = preg_split("/\r\n|\n|\r/", $export);
        $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [NULL, ']$1', ' => ['], $array);
        $export = join(PHP_EOL, array_filter(["["] + $array));
        if ((bool)$return) return $export;
        else echo $export;
    }
}
