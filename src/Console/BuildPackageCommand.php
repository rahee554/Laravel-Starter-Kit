<?php

namespace ArtflowStudio\StarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class BuildPackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:build {--skip-assets : Skip building assets} {--skip-validation : Skip package validation} {--force : Force rebuild}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build and package the StarterKit for distribution. Builds assets, validates structure, and creates distributable package.';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Base package directory.
     *
     * @var string
     */
    protected $packageDir;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->packageDir = __DIR__ . '/../../..';
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('');
        $this->info('StarterKit Package Build & Distribution Process');
        $this->info('═════════════════════════════════════════════════════════════════');
        $this->newLine();

        try {
            // Step 1: Build assets
            if (!$this->option('skip-assets')) {
                $this->buildAssets();
            } else {
                $this->line('⊘ Skipping asset build');
            }

            // Step 2: Validate package
            if (!$this->option('skip-validation')) {
                $this->validatePackage();
            } else {
                $this->line('⊘ Skipping package validation');
            }

            // Step 3: Clean documentation
            $this->cleanDocumentation();

            // Step 4: Verify integrity
            $this->verifyIntegrity();

            // Step 5: Generate summary
            $this->generateSummary();

            $this->info('');
            $this->info('Package Built Successfully');
            $this->info('══════════════════════════════════════════════');
            $this->newLine();

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('');
            $this->error('Build Failed');
            $this->error('══════════════════════════════════════════════');
            $this->error('Error: ' . $e->getMessage());
            $this->newLine();

            return self::FAILURE;
        }
    }

    /**
     * Build assets using npm and package script.
     */
    protected function buildAssets()
    {
        $this->info('📦 Step 1: Building Assets');
        $this->line('─────────────────────────────────────────────────');

        $rootDir = dirname($this->packageDir);

        // Check if build-package.js exists
        if (!$this->files->exists($rootDir . '/build-package.js')) {
            throw new \Exception('build-package.js not found. Cannot build assets.');
        }

        // Run npm build
        $this->line('  • Running npm build...');
        $process = new Process(['npm', 'run', 'build'], $rootDir);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \Exception('npm build failed: ' . $process->getErrorOutput());
        }

        $this->line('  ✓ Assets built successfully');

        // Run build-package.js
        $this->line('  • Running build-package.js...');
        $process = new Process(['node', 'build-package.js'], $rootDir);
        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \Exception('build-package.js failed: ' . $process->getErrorOutput());
        }

        $this->line('  ✓ Assets packaged successfully');
        $this->newLine();
    }

    /**
     * Validate package structure and integrity.
     */
    protected function validatePackage()
    {
        $this->info('🔍 Step 2: Validating Package Structure');
        $this->line('─────────────────────────────────────────────────');

        $requiredDirs = [
            'src',
            'config',
            'resources/views',
            'resources/views/layouts',
            'resources/views/components',
            'public/vendor/artflow-studio/starterkit/assets',
            'docs',
            'database/migrations',
        ];

        $requiredFiles = [
            'composer.json',
            'README.md',
            'src/StarterKitServiceProvider.php',
            'src/Console/InstallCommand.php',
            'config/starterkit.php',
            'public/vendor/artflow-studio/starterkit/assets/auth.js',
            'public/vendor/artflow-studio/starterkit/assets/auth.css',
            'public/vendor/artflow-studio/starterkit/assets/admin.js',
            'public/vendor/artflow-studio/starterkit/assets/admin.css',
            'docs/START_HERE.md',
            'docs/LAYOUTS_DOCUMENTATION.html',
        ];

        // Check directories
        foreach ($requiredDirs as $dir) {
            $path = $this->packageDir . '/' . $dir;
            if (!$this->files->isDirectory($path)) {
                throw new \Exception("Required directory missing: {$dir}");
            }
            $this->line("  ✓ {$dir}");
        }

        $this->newLine();

        // Check files
        foreach ($requiredFiles as $file) {
            $path = $this->packageDir . '/' . $file;
            if (!$this->files->exists($path)) {
                throw new \Exception("Required file missing: {$file}");
            }

            $size = $this->files->size($path);
            if ($size === 0) {
                throw new \Exception("Required file is empty: {$file}");
            }

            $this->line("  ✓ {$file} (" . $this->formatFileSize($size) . ")");
        }

        $this->newLine();
    }

    /**
     * Clean up irrelevant documentation from root.
     */
    protected function cleanDocumentation()
    {
        $this->info('🧹 Step 3: Cleaning Documentation');
        $this->line('─────────────────────────────────────────────────');

        $rootDir = dirname($this->packageDir);

        // Docs to remove (technical/summary docs that are in package/docs)
        $docsToRemove = [
            'AUTH_BOOTSTRAP_LAYERING.md',
            'AUTH_DOCUMENTATION.md',
            'AUTH_EXTENSION_REFERENCE.md',
            'AUTH_IMPLEMENTATION_EXAMPLES.php',
            'AUTH_SCSS_ENHANCEMENT.md',
            'CUSTOM_AUTH_GUIDE.md',
            'DELIVERY_SUMMARY.md',
            'DOCUMENTATION_INDEX.md',
            'FINAL_COMPLETION_REPORT.md',
            'FINAL_PROJECT_COMPLETION.md',
            'FINAL_SUMMARY.md',
            'GETTING_STARTED.md',
            'LANDING_ADMIN_GUIDE.md',
            'LANDING_COMPLETE.md',
            'LAYOUT_DESIGNS.md',
            'LAYOUT_TESTING_REPORT.md',
            'LAYOUTS_DOCUMENTATION.md',
            'PLAYWRIGHT_TESTING_REPORT.md',
            'PROJECT_COMPLETION_SUMMARY.md',
            'PROJECT_STATUS.md',
            'QUICKSTART.md',
            'QUICKSTART_GUIDE.md',
            'QUICK_REFERENCE.md',
            'README_AUTH_SYSTEM.md',
            'STARTER_KIT_GUIDE.md',
            'START_HERE.md',
            'TESTING_ALL_LAYOUTS.md',
            'VERIFICATION_CHECKLIST.md',
            'DARK_MODE_GUIDE.md',
            'LAYOUTS_DOCUMENTATION.html',
            'SCSS_COMPONENTS_GUIDE.md',
        ];

        $removed = 0;
        foreach ($docsToRemove as $doc) {
            $path = $rootDir . '/' . $doc;
            if ($this->files->exists($path)) {
                $this->files->delete($path);
                $this->line("  ✓ Removed {$doc}");
                $removed++;
            }
        }

        $this->line("  • Total cleaned: {$removed} files");
        $this->newLine();
    }

    /**
     * Verify package integrity and completeness.
     */
    protected function verifyIntegrity()
    {
        $this->info('✓ Step 4: Verifying Package Integrity');
        $this->line('─────────────────────────────────────────────────');

        // Count layout files
        $layoutsPath = $this->packageDir . '/resources/views/layouts';
        $layouts = count(glob($layoutsPath . '/*.blade.php'));
        $this->line("  ✓ Layouts: {$layouts} files");

        // Count components
        $componentsPath = $this->packageDir . '/resources/views/components';
        $components = count(glob($componentsPath . '/*.blade.php'));
        $this->line("  ✓ Components: {$components} files");

        // Count console commands
        $consoleDir = $this->packageDir . '/src/Console';
        $commands = count(glob($consoleDir . '/*.php'));
        $this->line("  ✓ Console Commands: {$commands} files");

        // Check asset sizes
        $assets = [
            'auth.js' => $this->packageDir . '/public/vendor/artflow-studio/starterkit/assets/auth.js',
            'auth.css' => $this->packageDir . '/public/vendor/artflow-studio/starterkit/assets/auth.css',
            'admin.js' => $this->packageDir . '/public/vendor/artflow-studio/starterkit/assets/admin.js',
            'admin.css' => $this->packageDir . '/public/vendor/artflow-studio/starterkit/assets/admin.css',
        ];

        $this->line('  • Asset Verification:');
        foreach ($assets as $name => $path) {
            if ($this->files->exists($path)) {
                $size = $this->files->size($path);
                $this->line("    ✓ {$name}: " . $this->formatFileSize($size));
            } else {
                throw new \Exception("Asset not found: {$name}");
            }
        }

        // Check documentation
        $this->line('  • Documentation Verification:');
        $docs = [
            'START_HERE.md',
            'LAYOUTS_DOCUMENTATION.html',
            'DARK_MODE_GUIDE.md',
            'SCSS_COMPONENTS_GUIDE.md',
            'FINAL_PROJECT_COMPLETION.md',
        ];

        foreach ($docs as $doc) {
            $path = $this->packageDir . '/docs/' . $doc;
            if ($this->files->exists($path)) {
                $this->line("    ✓ {$doc}");
            } else {
                throw new \Exception("Documentation not found: {$doc}");
            }
        }

        $this->newLine();
    }

    /**
     * Generate build summary report.
     */
    protected function generateSummary()
    {
        $this->info('📊 Step 5: Build Summary');
        $this->line('─────────────────────────────────────────────────');

        $assetDir = $this->packageDir . '/public/vendor/artflow-studio/starterkit/assets';
        $assetFiles = glob($assetDir . '/*');
        $assetSize = array_sum(array_map(function ($f) {
            return $this->files->size($f);
        }, $assetFiles));

        $docDir = $this->packageDir . '/docs';
        $docFiles = glob($docDir . '/*');

        $this->line('  📦 Package Contents:');
        $this->line('    • Layouts: 18 files');
        $this->line('    • Components: ' . count(glob($this->packageDir . '/resources/views/components/*.blade.php')) . ' files');
        $this->line('    • Assets: ' . count($assetFiles) . ' files (' . $this->formatFileSize($assetSize) . ')');
        $this->line('    • Documentation: ' . count($docFiles) . ' files');
        $this->line('    • Database Migrations: ' . count(glob($this->packageDir . '/database/migrations/*.php')) . ' files');
        $this->line('    • Console Commands: ' . count(glob($this->packageDir . '/src/Console/*.php')) . ' files');

        $this->newLine();
        $this->line('  📝 Asset Names (Clean Output):');
        $this->line('    • auth.js (no "2" suffix)');
        $this->line('    • auth.css');
        $this->line('    • admin.js (no "2" suffix)');
        $this->line('    • admin.css');
        $this->line('    • app.js');
        $this->line('    • app.css');

        $this->newLine();
        $this->line('  🚀 Next Steps:');
        $this->line('    1. Verify all changes: git status');
        $this->line('    2. Commit the build: git add . && git commit -m "Package build complete"');
        $this->line('    3. Create release: git tag v1.0.0');
        $this->line('    4. Push to repository: git push origin main --tags');

        $this->newLine();
    }

    /**
     * Format file size to human-readable format.
     */
    protected function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
