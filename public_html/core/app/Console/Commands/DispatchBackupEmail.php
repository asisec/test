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
    protected $description = 'Email the latest .sql.gz database backup from the textileforumDB directory';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $directory = base_path('../backups/databases/textileforumDB');

        if (! is_dir($directory)) {
            $this->error("Backup directory not found: {$directory}");

            return self::FAILURE;
        }

        $files = glob($directory . '/*.sql.gz');

        if (empty($files)) {
            $this->warn("No .sql.gz backup files found in: {$directory}");

            return self::FAILURE;
        }

        // Identify the single most recently modified .sql.gz file
        $latestFile = collect($files)
            ->filter(fn (string $file) => is_file($file))
            ->sortByDesc(fn (string $file) => filemtime($file))
            ->first();

        if (! $latestFile) {
            $this->warn("No valid .sql.gz files found in: {$directory}");

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