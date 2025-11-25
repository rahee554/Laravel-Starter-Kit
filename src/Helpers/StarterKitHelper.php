<?php

namespace ArtflowStudio\StarterKit\Helpers;

class StarterKitHelper
{
    /**
     * Get the default authentication layout view path.
     * 
     * Uses the configured default layout or falls back to 'particles'
     *
     * @return string The view path for the default auth layout
     */
    public static function getDefaultAuthLayoutView(): string
    {
        $layout = config('starterkit.auth_layout', 'particles');
        
        // Validate layout exists in list of available layouts
        $availableLayouts = [
            'centered', 'split', 'minimal', 'glass', 'particles',
            'hero', 'modern', '3d', 'premium-dark', 'gradient-flow',
            'clean', 'hero-grid', 'sidebar', 'base'
        ];
        
        if (!in_array($layout, $availableLayouts)) {
            \Log::warning("Invalid StarterKit auth layout: {$layout}. Falling back to 'particles'.");
            $layout = 'particles';
        }
        
        return "starterkit::layouts.starterkit.auth.{$layout}";
    }

    /**
     * Get the default admin layout view path.
     * 
     * Uses the configured default layout or falls back to 'sidebar'
     *
     * @return string The view path for the default admin layout
     */
    public static function getDefaultAdminLayoutView(): string
    {
        $layout = config('starterkit.admin_layout', 'sidebar');
        
        // Validate layout exists in list of available layouts
        $availableLayouts = ['sidebar', 'topnav', 'minimal', 'neo', 'classic'];
        
        if (!in_array($layout, $availableLayouts)) {
            \Log::warning("Invalid StarterKit admin layout: {$layout}. Falling back to 'sidebar'.");
            $layout = 'sidebar';
        }
        
        return "starterkit::layouts.starterkit.admin.{$layout}";
    }

    /**
     * Get all available authentication layouts.
     *
     * @return array
     */
    public static function getAvailableAuthLayouts(): array
    {
        return [
            'centered' => 'Centered Box Layout',
            'split' => 'Split Screen with Branding',
            'minimal' => 'Clean Minimal Design',
            'glass' => 'Glassmorphism Effect',
            'particles' => 'Animated Particles Background',
            'hero' => 'Large Hero Section',
            'modern' => 'Contemporary Design',
            '3d' => 'Three-Dimensional Effects',
            'premium-dark' => 'Dark Premium Theme',
            'gradient-flow' => 'Animated Gradients',
            'clean' => 'Minimalist Approach',
            'hero-grid' => 'Grid-Based Hero',
            'sidebar' => 'Sidebar-Based Auth',
            'base' => 'Base Layout (No Styling)',
        ];
    }

    /**
     * Get all available admin layouts.
     *
     * @return array
     */
    public static function getAvailableAdminLayouts(): array
    {
        return [
            'sidebar' => 'Classic Sidebar Navigation',
            'topnav' => 'Horizontal Top Navigation',
            'minimal' => 'Clean Minimalist Admin',
            'neo' => 'Modern Futuristic Admin',
            'classic' => 'Traditional Admin Panel',
        ];
    }
}
