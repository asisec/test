<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DispatchBackupEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:dispatch-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email the latest database backup file from the Textile Forum storage directory';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $directory = storage_path('app/Textile Forum');

        if (! is_dir($directory)) {
            $this->error("Backup directory not found: {$directory}");

            return self::FAILURE;
        }

        $files = glob($directory . '/*');

        if (empty($files)) {
            $this->warn("No backup files found in: {$directory}");

            return self::FAILURE;
        }

        // Identify the single most recently modified file
        $latestFile = collect($files)
            ->filter(fn (string $file) => is_file($file))
            ->sortByDesc(fn (string $file) => filemtime($file))
            ->first();

        if (! $latestFile) {
            $this->warn("No valid files found in: {$directory}");

            return self::FAILURE;
        }

        $date = now()->format('Y-m-d');
        $subject = "TextileForum Backup - {$date}";

        Mail::raw(
            "Attached is the latest TextileForum backup file: " . basename($latestFile),
            function ($message) use ($latestFile, $subject) {
                $message->to('ymert8225@gmail.com')
                    ->subject($subject)
                    ->attach($latestFile);
            }
        );

        $this->info("Backup email dispatched successfully: " . basename($latestFile));

        return self::SUCCESS;
    }
}