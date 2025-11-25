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
    protected $description = 'Install StarterKit with authentication layouts and custom services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Installing StarterKit...');
        $this->newLine();

        // 1. Check if Fortify config exists (installed via composer)
        if (!File::exists(config_path('fortify.php'))) {
            $this->warn('⚠️  Laravel Fortify not detected.');
            $this->line('Please install Fortify first:');
            $this->line('  composer require laravel/fortify');
            $this->line('  php artisan fortify:install');
            $this->newLine();
            
            if ($this->confirm('Would you like to run fortify:install now?', true)) {
                $this->call('fortify:install');
                $this->newLine();
            } else {
                $this->warn('StarterKit requires Fortify. Please install it and run starterkit:install again.');
                return Command::FAILURE;
            }
        } else {
            $this->info('✓ Laravel Fortify detected');
        }

        // 2. Publish StarterKit configuration
        $this->info('⚙️  Publishing StarterKit configuration...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-config',
            '--force' => $this->option('force')
        ]);

        // 3. Publish pre-built assets
        $this->info('📦 Publishing pre-built assets...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-assets',
            '--force' => $this->option('force')
        ]);

        // 4. Copy test routes (optional)
        if ($this->confirm('Install layout testing routes? (recommended for development)', true)) {
            $this->copyRoutes();
        }

        // 5. Update .env for layout selection
        $this->updateEnvFile();

        // 6. Run migrations if desired
        if ($this->confirm('Run database migrations?', true)) {
            $this->call('migrate');
        }

        $this->newLine();
        $this->info('✅ StarterKit installed successfully!');
        $this->newLine();
        $this->line('What\'s included:');
        $this->line('  ✓ 14 authentication layouts (served from package)');
        $this->line('  ✓ 5 admin layouts (served from package)');
        $this->line('  ✓ Pre-built CSS/JS assets');
        $this->line('  ✓ Laravel Fortify integration');
        $this->line('  ✓ Dynamic layout configuration');
        $this->newLine();
        
        $this->info('📌 Configuration');
        $this->line('Change layouts in .env or config/starterkit.php:');
        $this->line('  STARTERKIT_AUTH_LAYOUT=particles');
        $this->line('  STARTERKIT_ADMIN_LAYOUT=sidebar');
        $this->newLine();
        
        // Verify assets exist
        $this->verifyAssets();
        
        $this->line('Next steps:');
        $this->line('  1. Visit /login to see your authentication pages');
        $this->line('  2. Visit /test/layouts to preview all layouts');
        $this->line('  3. Change STARTERKIT_AUTH_LAYOUT in .env to switch layouts');
        $this->newLine();
        $this->line('Available auth layouts: centered, split, minimal, glass, particles,');
        $this->line('  hero, modern, 3d, premium-dark, gradient-flow, clean, hero-grid, sidebar, base');
        $this->newLine();

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
        $this->info('✓ Layout testing routes published');

        // Update web.php to include test routes
        $webRoutesPath = base_path('routes/web.php');
        $webRoutesContent = File::get($webRoutesPath);

        if (!str_contains($webRoutesContent, "require __DIR__.'/test-layouts.php'")) {
            $addition = "\n// StarterKit Layout Testing Routes\nrequire __DIR__.'/test-layouts.php';\n";
            File::append($webRoutesPath, $addition);
            $this->info('✓ Layout test routes linked to web.php');
        }
    }

    /**
     * Verify that published assets exist.
     */
    protected function verifyAssets()
    {
        $assetsCss = public_path('vendor/artflow-studio/starterkit/assets/auth.css');
        $assetsJs = public_path('vendor/artflow-studio/starterkit/assets/auth.js');

        if (!File::exists($assetsCss) || !File::exists($assetsJs)) {
            $this->warn('⚠️  Warning: Pre-built assets not found!');
            $this->line('Please run: php artisan vendor:publish --tag=starterkit-assets --force');
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
            $this->warn('.env file not found - skipping configuration');
            return;
        }

        $envContent = File::get($envPath);

        if (!str_contains($envContent, 'STARTERKIT_AUTH_LAYOUT')) {
            $addition = "\n# StarterKit Configuration\nSTARTERKIT_AUTH_LAYOUT={$layout}\nSTARTERKIT_ADMIN_LAYOUT=sidebar\n";
            File::append($envPath, $addition);
            $this->info("✓ Added .env configuration (auth layout: {$layout})");
        }
    }
}
