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

        // 1. Install Fortify first if not already installed
        if (!File::exists(config_path('fortify.php'))) {
            $this->info('📦 Installing Laravel Fortify...');
            $this->call('fortify:install');
            $this->newLine();
        } else {
            $this->info('✓ Laravel Fortify already installed');
        }

        // 2. Publish auth layouts (default)
        $this->info('📐 Publishing authentication layouts...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-auth-layouts',
            '--force' => $this->option('force')
        ]);

        // 3. Publish pre-built assets (default)
        $this->info('📦 Publishing pre-built assets...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-assets',
            '--force' => $this->option('force')
        ]);

        // 4. Publish configuration (default)
        $this->info('⚙️  Publishing configuration...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-config',
            '--force' => $this->option('force')
        ]);

        // 5. Publish custom services and middleware
        $this->info('🔧 Publishing custom auth services...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-services',
            '--force' => $this->option('force')
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'starterkit-middleware',
            '--force' => $this->option('force')
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'starterkit-listeners',
            '--force' => $this->option('force')
        ]);

        // 6. Copy routes
        $this->copyRoutes();

        // 7. Update .env for layout selection
        $this->updateEnvFile();

        // 8. Run migrations if desired
        if ($this->confirm('Run database migrations?', true)) {
            $this->call('migrate');
        }

        $this->newLine();
        $this->info('✅ StarterKit installed successfully!');
        $this->newLine();
        $this->line('What\'s included:');
        $this->line('  ✓ 13 authentication layouts');
        $this->line('  ✓ Pre-built CSS/JS (no build required)');
        $this->line('  ✓ Laravel Fortify integration');
        $this->line('  ✓ Custom auth middleware');
        $this->line('  ✓ Custom auth services');
        $this->line('  ✓ Event listeners');
        $this->newLine();
        $this->line('Next steps:');
        $this->line('  1. Visit /login to see your authentication pages');
        $this->line('  2. Visit /test/layouts to preview all layouts');
        $this->line('  3. Customize app/Services/AuthService.php for your logic');
        $this->line('  4. Register listeners in app/Providers/EventServiceProvider.php');
        $this->newLine();
        $this->line('Optional commands:');
        $this->line('  php artisan vendor:publish --tag=starterkit-admin-layouts');
        $this->line('  php artisan vendor:publish --tag=starterkit-docs');
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
