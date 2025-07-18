<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyStorageFiles extends Command
{
    protected $signature = 'storage:copy-files';
    protected $description = 'Copy files from storage/app/public to public/storage';

    public function handle()
    {
        $sourcePath = storage_path('app/public');
        $targetPath = public_path('storage');

        if (!File::exists($sourcePath)) {
            $this->error('Source path does not exist: ' . $sourcePath);
            return;
        }

        if (!File::exists($targetPath)) {
            File::makeDirectory($targetPath, 0755, true);
        }

        $this->copyDirectory($sourcePath, $targetPath);
        $this->info('Files copied successfully!');
    }

    private function copyDirectory($source, $target)
    {
        $files = File::allFiles($source);
        
        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            $targetFile = $target . '/' . $relativePath;
            
            File::ensureDirectoryExists(dirname($targetFile));
            File::copy($file->getPathname(), $targetFile);
            
            $this->line('Copied: ' . $relativePath);
        }
    }
}