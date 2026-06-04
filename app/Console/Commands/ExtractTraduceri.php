<?php

namespace App\Console\Commands;

use App\Models\Traducere;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExtractTraduceri extends Command
{
    protected $signature = 'traduceri:extract {--dry-run : Doar afiseaza, fara scriere}';

    protected $description = 'Scaneaza Blade-urile dupa __(\'...\') si face upsert in tabela traduceri (idempotent, nu suprascrie valori existente)';

    public function handle(): int
    {
        $files = File::allFiles(resource_path('views'));
        $found = [];

        foreach ($files as $file) {
            if (! str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }

            $content = $file->getContents();

            preg_match_all('/__\(\s*\'((?:[^\'\\\\]|\\\\.)+)\'\s*[\),]/', $content, $single);
            preg_match_all('/__\(\s*"((?:[^"\\\\]|\\\\.)+)"\s*[\),]/', $content, $double);

            $keys = array_merge(
                array_map(fn (string $k): string => stripcslashes($k), $single[1]),
                array_map(fn (string $k): string => stripcslashes($k), $double[1]),
            );

            $grup = $this->grupPentru($file->getRelativePathname());

            foreach ($keys as $key) {
                // Prima aparitie castiga grupul (navbar/footer inaintea blocurilor generice).
                $found[$key] ??= $grup;
            }
        }

        if ($found === []) {
            $this->warn('Nicio cheie __() gasita.');

            return self::SUCCESS;
        }

        $created = 0;

        foreach ($found as $cheie => $grup) {
            if ($this->option('dry-run')) {
                $this->line(sprintf('[%s] %s', $grup, $cheie));

                continue;
            }

            $traducere = Traducere::firstOrCreate(
                ['cheie' => $cheie],
                ['grup' => $grup, 'valoare' => ['ro' => $cheie, 'de' => null, 'en' => null]],
            );

            if ($traducere->wasRecentlyCreated) {
                $created++;
            }
        }

        $this->info(sprintf('%d chei gasite, %d noi create.', count($found), $created));

        return self::SUCCESS;
    }

    private function grupPentru(string $path): string
    {
        return match (true) {
            str_contains($path, 'navbar') => 'nav',
            str_contains($path, 'footer') => 'footer',
            str_contains($path, 'cookie') => 'cookies',
            str_contains($path, 'livewire') => 'forms',
            str_contains($path, 'blocks') => 'blocks',
            default => 'general',
        };
    }
}
