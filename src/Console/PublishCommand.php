<?php

namespace ArtflowStudio\StarterKit\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starterkit:publish
                            {--force : Overwrite existing files}
                            {--tag= : Specific tag to publish (assets, views, config)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish StarterKit assets, views, or configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tag = $this->option('tag');

        if ($tag) {
            $this->publishSpecificTag($tag);
        } else {
            $this->publishAll();
        }

        return Command::SUCCESS;
    }

    /**
     * Publish specific tag.
     */
    protected function publishSpecificTag($tag)
    {
        $validTags = ['assets', 'views', 'config', 'migrations', 'docs'];
        
        if (!in_array($tag, $validTags)) {
            $this->error("Invalid tag: {$tag}");
            $this->line("Valid tags: " . implode(', ', $validTags));
            return;
        }

        $this->info("Publishing StarterKit {$tag}...");
        
        $this->call('vendor:publish', [
            '--tag' => "starterkit-{$tag}",
            '--force' => $this->option('force')
        ]);

        if ($tag === 'assets') {
            $this->info("✅ Pre-built assets published - No build required!");
        } else {
            $this->info("✅ {$tag} published successfully!");
        }
    }

    /**
     * Publish all assets.
     */
    protected function publishAll()
    {
        $this->info('Publishing all StarterKit assets...');
        $this->newLine();

        // Publish assets
        $this->line('Publishing pre-built assets...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-assets',
            '--force' => $this->option('force')
        ]);

        // Publish views
        $this->line('Publishing views...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-views',
            '--force' => $this->option('force')
        ]);

        // Publish docs
        $this->line('Publishing documentation...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-docs',
            '--force' => $this->option('force')
        ]);

        // Publish config
        $this->line('Publishing configuration...');
        $this->call('vendor:publish', [
            '--tag' => 'starterkit-config',
            '--force' => $this->option('force')
        ]);

        $this->newLine();
        $this->info('✅ All assets published successfully!');
        $this->info('📦 Pre-built assets ready - No build required!');
    }
}
