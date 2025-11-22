<?php

namespace ArtflowStudio\StarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkit:install
                            {--force : Overwrite existing files}
                            {--layout= : Default auth layout to use}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Artflow Studio StarterKit with authentication and admin layouts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing Artflow Studio StarterKit...');
        $this->newLine();

        // 1. Publish all assets (pre-built, no build needed!)
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-assets',
            '--force' => $this->option('force')
        ]);

        // 2. Publish views
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-views',
            '--force' => $this->option('force')
        ]);

        // 3. Publish configuration
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-config',
            '--force' => $this->option('force')
        ]);

        // 4. Install Fortify if not already installed
        if (!File::exists(config_path('fortify.php'))) {
            $this->info('Installing Laravel Fortify...');
            $this->call('fortify:install');
        }

        // 5. Copy routes
        $this->copyRoutes();

        // 6. Update .env for layout selection
        $this->updateEnvFile();

        $this->newLine();
        $this->info('✅ StarterKit installed successfully!');
        $this->newLine();
        $this->line('📦 Pre-built assets published - No build required!');
        $this->line('📚 Documentation included in package (docs/starterkit/)');
        $this->newLine();
        $this->line('Next steps:');
        $this->line('1. Configure your database in .env');
        $this->line('2. Run: php artisan migrate');
        $this->line('3. Visit /login to see your authentication pages');
        $this->line('4. Visit /test/layouts to preview all available layouts');
        $this->newLine();
        $this->line('Optional: Publish documentation & Fortify customizations');
        $this->line('  php artisan vendor:publish --tag=starterkit-docs');
        $this->line('  php artisan vendor:publish --tag=starterkit-fortify-customizations');
        $this->newLine();
        $this->line('Available auth layouts:');
        $this->line('  - centered, split, minimal, glass, particles');
        $this->line('  - hero, modern, 3d, premium-dark, gradient-flow');
        $this->line('  - clean, hero-grid, sidebar');
        $this->newLine();
        $this->line('Available admin layouts:');
        $this->line('  - sidebar, topnav, minimal, neo, classic');
        $this->newLine();
        $this->line('For more info: See package documentation');

        return Command::SUCCESS;
    }

    /**
     * Copy route files to the application.
     */
    protected function copyRoutes()
    {
        $sourcePath = __DIR__.'/../../routes/test-layouts.php';
        $destinationPath = base_path('routes/test-layouts.php');

        if (File::exists($destinationPath) && !$this->option('force')) {
            if (!$this->confirm('routes/test-layouts.php already exists. Overwrite?')) {
                return;
            }
        }

        File::copy($sourcePath, $destinationPath);
        $this->info('✓ Test layout routes published');

        // Update web.php to include test routes
        $webRoutesPath = base_path('routes/web.php');
        $webRoutesContent = File::get($webRoutesPath);

        if (!str_contains($webRoutesContent, "require __DIR__.'/test-layouts.php'")) {
            $addition = "\n// StarterKit Test Layout Routes\nrequire __DIR__.'/test-layouts.php';\n";
            File::append($webRoutesPath, $addition);
            $this->info('✓ Test routes added to web.php');
        }
    }

    /**
     * Update .env file with default layout configuration.
     */
    protected function updateEnvFile()
    {
        $envPath = base_path('.env');
        $layout = $this->option('layout') ?? 'particles';

        if (!File::exists($envPath)) {
            $this->warn('.env file not found');
            return;
        }

        $envContent = File::get($envPath);

        if (!str_contains($envContent, 'STARTERKIT_AUTH_LAYOUT')) {
            $addition = "\n# StarterKit Configuration\nSTARTERKIT_AUTH_LAYOUT={$layout}\nSTARTERKIT_ADMIN_LAYOUT=sidebar\n";
            File::append($envPath, $addition);
            $this->info("✓ Added STARTERKIT configuration to .env (auth layout: {$layout})");
        }
    }
}
