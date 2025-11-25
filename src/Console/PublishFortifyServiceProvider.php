<?php

namespace ArtflowStudio\StarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class PublishFortifyServiceProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkit:publish-fortify-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the FortifyServiceProvider to your application';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sourcePath = __DIR__ . '/../Providers/FortifyServiceProvider.php';
        $destinationPath = app_path('Providers/FortifyServiceProvider.php');

        if (!file_exists($sourcePath)) {
            $this->error("Source file not found: {$sourcePath}");
            return 1;
        }

        // Create the Providers directory if it doesn't exist
        if (!is_dir(app_path('Providers'))) {
            mkdir(app_path('Providers'), 0755, true);
        }

        // Copy the file
        if (File::copy($sourcePath, $destinationPath)) {
            $this->info('FortifyServiceProvider published successfully!');
            $this->line('');
            $this->line('<info>Next steps:</info>');
            $this->line('1. Register the provider in your config/app.php:');
            $this->line('   App\Providers\FortifyServiceProvider::class,');
            $this->line('');
            $this->line('2. Update your FortifyServiceProvider to include your custom actions:');
            $this->line('   - CreateNewUser');
            $this->line('   - UpdateUserProfileInformation');
            $this->line('   - UpdateUserPassword');
            $this->line('   - ResetUserPassword');
            $this->line('   - RedirectIfTwoFactorAuthenticatable');

            return 0;
        } else {
            $this->error('Failed to publish FortifyServiceProvider');
            return 1;
        }
    }
}
