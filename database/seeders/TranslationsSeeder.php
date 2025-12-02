<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\System\Settings\Settings\Key;
use App\Models\System\Settings\Settings\Language;
use App\Models\System\Settings\Settings\Translations;


class TranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langPath = base_path('lang');

        // Discover languages by subdirectories (preferred) or by files in lang/
        $languageDirs = [];
        if (File::isDirectory($langPath)) {
            foreach (File::directories($langPath) as $dir) {
                $languageDirs[] = basename($dir);
            }

            if (empty($languageDirs)) {
                // fallback to files like en.php, php_en.json
                foreach (File::files($langPath) as $file) {
                    $name = $file->getFilename();
                    if (preg_match('/^(php_)?([a-z]{2,3})\.(php|json)$/i', $name, $m)) {
                        $languageDirs[] = strtolower($m[2]);
                    }
                }
                $languageDirs = array_values(array_unique($languageDirs));
            }
        } else {
            $this->command->error("⚠️  lang directory not found at {$langPath}");
            return;
        }

        if (empty($languageDirs)) {
            $this->command->warn("⚠️  No language directories or files were detected in lang/");
            return;
        }

        // Sort languages: English first, then alphabetically
        $languageDirs = $this->sortLanguagesWithEnglishFirst($languageDirs);

        // Define language directions (RTL vs LTR)
        $languageDirections = $this->getLanguageDirections();

        // Create or get Language models
        $languageModels = [];
        foreach ($languageDirs as $langCode) {
            $direction = $languageDirections[$langCode] ?? 'ltr'; // Default to LTR if not specified
            
            // i want not set ar
            if ($langCode === 'ar') {
                $this->command->info("ℹ️  Skipping language 'ar' as per configuration");
                continue;
            }

            $languageModels[$langCode] = Language::firstOrCreate(
                ['name' => $langCode, 'slug' => $langCode],
                ['direction' => $direction]
            );
            $this->command->info("✅ Language '{$langCode}' ready (ID: {$languageModels[$langCode]->id}, Direction: {$direction})");
        }

        $this->command->info("🗑️  Clearing existing data...");
        // Truncate tables to ensure fresh state and reset auto-increment
        // Disable foreign key checks around truncation for MySQL
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            Translations::truncate();
            Key::truncate();
            $this->command->info("✅ Truncated translations and keys tables");
        } catch (\Throwable $e) {
            // Fall back to delete if truncate fails (e.g., unsupported DB)
            Translations::query()->delete();
            Key::query()->delete();
            $this->command->warn("⚠️  Truncate failed, performed delete instead: " . $e->getMessage());
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Collect all keys and translations
        $allKeys = collect();
        $allTranslations = [];

        foreach ($languageDirs as $langCode) {
            $this->command->info("📖 Loading translations for language: {$langCode} ...");
            $collected = [];

            $dirPath = $langPath . DIRECTORY_SEPARATOR . $langCode;

            // If language folder exists (lang/en/auth.php etc.)
            if (File::isDirectory($dirPath)) {
                foreach (File::files($dirPath) as $file) {
                    $ext = $file->getExtension();
                    $fileBase = $file->getBasename('.' . $ext);

                    try {
                        if ($ext === 'php') {
                            $data = include $file->getPathname();
                            if (is_array($data)) {
                                // Prefix keys with filename: auth.login -> from auth.php
                                $flattened = $this->flattenArray($data, $fileBase);
                                $collected = array_merge($collected, $flattened);
                            } else {
                                $this->command->warn("⚠️  {$file->getFilename()} did not return an array");
                            }
                        } elseif ($ext === 'json') {
                            $json = json_decode(File::get($file->getPathname()), true);
                            if (is_array($json)) {
                                $flattened = $this->flattenArray($json, $fileBase);
                                $collected = array_merge($collected, $flattened);
                            } else {
                                $this->command->warn("⚠️  {$file->getFilename()} contains invalid JSON");
                            }
                        }
                    } catch (\Throwable $e) {
                        $this->command->error("❌ Error including {$file->getFilename()}: {$e->getMessage()}");
                    }
                }
            } else {
                // No subdirectory: check for files like en.php or php_en.json in lang/
                $possiblePhp = $langPath . DIRECTORY_SEPARATOR . "{$langCode}.php";
                $possibleJson = $langPath . DIRECTORY_SEPARATOR . "php_{$langCode}.json";

                if (File::exists($possiblePhp)) {
                    try {
                        $data = include $possiblePhp;
                        if (is_array($data)) {
                            // No filename available to prefix, use lang file's base as prefix if possible
                            $flattened = $this->flattenArray($data, pathinfo($possiblePhp, PATHINFO_FILENAME));
                            $collected = array_merge($collected, $flattened);
                        }
                    } catch (\Throwable $e) {
                        $this->command->error("❌ Error including {$possiblePhp}: {$e->getMessage()}");
                    }
                } elseif (File::exists($possibleJson)) {
                    $json = json_decode(File::get($possibleJson), true);
                    if (is_array($json)) {
                        $flattened = $this->flattenArray($json, pathinfo($possibleJson, PATHINFO_FILENAME));
                        $collected = array_merge($collected, $flattened);
                    } else {
                        $this->command->warn("⚠️  {$possibleJson} contains invalid JSON");
                    }
                } else {
                    $this->command->warn("⚠️  No files found for language code '{$langCode}'");
                }
            }

            $allTranslations[$langCode] = $collected;
            $allKeys = $allKeys->merge(array_keys($collected));
            $this->command->info("✅ Found " . count($collected) . " {$langCode} translation entries");
        }

        // Unique keys
        $uniqueKeys = $allKeys->unique()->values();
        $this->command->info("🔑 Found " . $uniqueKeys->count() . " unique translation keys");

        // Insert keys in chunks
        $keyData = $uniqueKeys->map(function ($key) {
            return [
                'key' => $key,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        $keyChunks = array_chunk($keyData, 500);
        foreach ($keyChunks as $chunk) {
            Key::insert($chunk);
        }

        // Map keys to IDs
        $keyModels = Key::pluck('id', 'key')->toArray();
        $this->command->info("✅ Inserted " . count($keyModels) . " translation keys");

        // Insert translations (language by language)
        foreach ($allTranslations as $langCode => $translations) {
            $translationData = [];

            foreach ($translations as $key => $value) {
                if (isset($keyModels[$key]) && isset($languageModels[$langCode])) {
                    if (is_array($value) || is_object($value)) {
                        $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                    } else {
                        $value = (string)$value;
                    }

                    $translationData[] = [
                        'key_id' => $keyModels[$key],
                        'value' => $value,
                        'language_id' => $languageModels[$langCode]->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($translationData)) {
                $chunks = array_chunk($translationData, 500);
                foreach ($chunks as $chunk) {
                    Translations::insert($chunk);
                }

                $this->command->info("✅ Inserted " . count($translationData) . " {$langCode} translations");
            }
        }

        $this->command->info("🎉 Translation seeding completed!");
        $this->command->info("📊 Summary:");
        $this->command->info("   - Languages: " . count($languageModels));
        $this->command->info("   - Unique keys: " . Key::count());
        $this->command->info("   - Total translations: " . Translations::count());
    }

    /**
     * Get language direction mapping (RTL vs LTR).
     *
     * @return array
     */
    private function getLanguageDirections(): array
    {
        return [
            // Right-to-Left (RTL) languages
            'ar' => 'rtl',     // Arabic
            'he' => 'rtl',     // Hebrew
            'fa' => 'rtl',     // Persian/Farsi
            'ur' => 'rtl',     // Urdu
            'ku' => 'rtl',     // Kurdish
            'ckb' => 'rtl',    // Central Kurdish (Sorani)
            'ps' => 'rtl',     // Pashto
            'sd' => 'rtl',     // Sindhi
            'yi' => 'rtl',     // Yiddish
            'arc' => 'rtl',    // Aramaic
            'syc' => 'rtl',    // Classical Syriac
            'dv' => 'rtl',     // Divehi/Maldivian

            // Left-to-Right (LTR) languages - most common, but listed for clarity
            'en' => 'ltr',     // English
            'es' => 'ltr',     // Spanish
            'fr' => 'ltr',     // French
            'de' => 'ltr',     // German
            'it' => 'ltr',     // Italian
            'pt' => 'ltr',     // Portuguese
            'ru' => 'ltr',     // Russian
            'zh' => 'ltr',     // Chinese
            'ja' => 'ltr',     // Japanese
            'ko' => 'ltr',     // Korean
            'hi' => 'ltr',     // Hindi
            'tr' => 'ltr',     // Turkish
            'nl' => 'ltr',     // Dutch
            'sv' => 'ltr',     // Swedish
            'no' => 'ltr',     // Norwegian
            'da' => 'ltr',     // Danish
            'fi' => 'ltr',     // Finnish
            'pl' => 'ltr',     // Polish
            'cs' => 'ltr',     // Czech
            'hu' => 'ltr',     // Hungarian
            'ro' => 'ltr',     // Romanian
            'bg' => 'ltr',     // Bulgarian
            'hr' => 'ltr',     // Croatian
            'sk' => 'ltr',     // Slovak
            'sl' => 'ltr',     // Slovenian
            'et' => 'ltr',     // Estonian
            'lv' => 'ltr',     // Latvian
            'lt' => 'ltr',     // Lithuanian
            'el' => 'ltr',     // Greek
            'th' => 'ltr',     // Thai
            'vi' => 'ltr',     // Vietnamese
            'id' => 'ltr',     // Indonesian
            'ms' => 'ltr',     // Malay
            'tl' => 'ltr',     // Filipino/Tagalog
            'sw' => 'ltr',     // Swahili
            'am' => 'ltr',     // Amharic
            'bn' => 'ltr',     // Bengali
            'gu' => 'ltr',     // Gujarati
            'kn' => 'ltr',     // Kannada
            'ml' => 'ltr',     // Malayalam
            'mr' => 'ltr',     // Marathi
            'ne' => 'ltr',     // Nepali
            'or' => 'ltr',     // Odia
            'pa' => 'ltr',     // Punjabi
            'si' => 'ltr',     // Sinhala
            'ta' => 'ltr',     // Tamil
            'te' => 'ltr',     // Telugu
            'my' => 'ltr',     // Myanmar/Burmese
            'km' => 'ltr',     // Khmer/Cambodian
            'lo' => 'ltr',     // Lao
            'ka' => 'ltr',     // Georgian
            'hy' => 'ltr',     // Armenian
            'az' => 'ltr',     // Azerbaijani
            'kk' => 'ltr',     // Kazakh
            'ky' => 'ltr',     // Kyrgyz
            'mn' => 'ltr',     // Mongolian
            'uz' => 'ltr',     // Uzbek
            'tk' => 'ltr',     // Turkmen
            'tg' => 'ltr',     // Tajik
            'af' => 'ltr',     // Afrikaans
            'sq' => 'ltr',     // Albanian
            'eu' => 'ltr',     // Basque
            'be' => 'ltr',     // Belarusian
            'bs' => 'ltr',     // Bosnian
            'ca' => 'ltr',     // Catalan
            'cy' => 'ltr',     // Welsh
            'ga' => 'ltr',     // Irish
            'gd' => 'ltr',     // Scottish Gaelic
            'is' => 'ltr',     // Icelandic
            'mt' => 'ltr',     // Maltese
            'mk' => 'ltr',     // Macedonian
            'sr' => 'ltr',     // Serbian
            'uk' => 'ltr',     // Ukrainian
        ];
    }

    /**
     * Sort languages array with English first, then others alphabetically.
     *
     * @param array $languages
     * @return array
     */
    private function sortLanguagesWithEnglishFirst(array $languages): array
    {
        $english = [];
        $others = [];

        foreach ($languages as $lang) {
            if (strtolower($lang) === 'en') {
                $english[] = $lang;
            } else {
                $others[] = $lang;
            }
        }

        // Sort other languages alphabetically
        sort($others);

        // Merge with English first
        return array_merge($english, $others);
    }

    /**
     * Flatten multi-dimensional arrays into dot-notated keys and optionally prefix with filename.
     *
     * @param array  $array
     * @param string $prefix
     * @return array
     */
    private function flattenArray(array $array, string $prefix = ''): array
    {
        $result = [];

        $flatten = function ($items, $parentKey = '') use (&$flatten, &$result) {
            foreach ($items as $k => $v) {
                $fullKey = $parentKey === '' ? $k : ($parentKey . '.' . $k);
                if (is_array($v)) {
                    $flatten($v, $fullKey);
                } else {
                    $result[$fullKey] = $v;
                }
            }
        };

        $flatten($array, '');

        if ($prefix !== '') {
            $prefixed = [];
            foreach ($result as $k => $v) {
                $prefixed["{$prefix}.{$k}"] = $v;
            }
            return $prefixed;
        }

        return $result;
    }
}
