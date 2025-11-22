<?php

use Illuminate\Support\Facades\Route;

/**
 * Test routes for all authentication and admin layouts
 * These routes allow previewing all layout variations
 */

// Authentication Layout Test Routes
Route::prefix('test/auth')->name('test.auth.')->group(function () {
    
    // Centered Layout (Default)
    Route::get('/centered', function () {
        return view('test.auth.centered');
    })->name('centered');
    
    // Split Screen Layout
    Route::get('/split', function () {
        return view('test.auth.split');
    })->name('split');
    
    // Minimal Layout
    Route::get('/minimal', function () {
        return view('test.auth.minimal');
    })->name('minimal');
    
    // Glass Morphism Layout
    Route::get('/glass', function () {
        return view('test.auth.glass');
    })->name('glass');
    
    // Particles.js Layout
    Route::get('/particles', function () {
        return view('test.auth.particles');
    })->name('particles');
    
    // Hero Layout
    Route::get('/hero', function () {
        return view('test.auth.hero');
    })->name('hero');
    
    // Modern Layout
    Route::get('/modern', function () {
        return view('test.auth.modern');
    })->name('modern');
    
    // 3D Layout
    Route::get('/3d', function () {
        return view('test.auth.3d');
    })->name('3d');
    
    // Premium Dark Layout
    Route::get('/premium-dark', function () {
        return view('test.auth.premium-dark');
    })->name('premium-dark');
    
    // Gradient Flow Layout
    Route::get('/gradient-flow', function () {
        return view('test.auth.gradient-flow');
    })->name('gradient-flow');
    
    // Clean Layout
    Route::get('/clean', function () {
        return view('test.auth.clean');
    })->name('clean');
    
    // Hero Grid Layout
    Route::get('/hero-grid', function () {
        return view('test.auth.hero-grid');
    })->name('hero-grid');
});

// Admin Layout Test Routes
Route::prefix('test/admin')->name('test.admin.')->group(function () {
    
    // Sidebar Layout (Default)
    Route::get('/sidebar', function () {
        return view('test.admin.sidebar');
    })->name('sidebar');
    
    // Top Navigation Layout
    Route::get('/topnav', function () {
        return view('test.admin.topnav');
    })->name('topnav');
    
    // Minimal Layout
    Route::get('/minimal', function () {
        return view('test.admin.minimal');
    })->name('minimal');
    
    // Neo Layout (Modern/Future)
    Route::get('/neo', function () {
        return view('test.admin.neo');
    })->name('neo');
    
    // Classic Layout
    Route::get('/classic', function () {
        return view('test.admin.classic');
    })->name('classic');
});

// Layout Showcase - Overview of all layouts
Route::get('/test/layouts', function () {
    return view('test.layout-showcase', [
        'auth_layouts' => [
            'centered' => 'Centered Box - Classic centered authentication',
            'split' => 'Split Screen - Left brand, right form',
            'minimal' => 'Minimal - Clean and simple',
            'glass' => 'Glass Morphism - Modern glassmorphism effect',
            'particles' => 'Particles - Animated particle background',
            'hero' => 'Hero - Large hero section',
            'modern' => 'Modern - Contemporary design',
            '3d' => '3D - Three-dimensional effects',
            'premium-dark' => 'Premium Dark - Dark theme with premium feel',
            'gradient-flow' => 'Gradient Flow - Animated gradient background',
            'clean' => 'Clean - Minimalist approach',
            'hero-grid' => 'Hero Grid - Grid-based hero layout',
        ],
        'admin_layouts' => [
            'sidebar' => 'Sidebar - Classic sidebar navigation',
            'topnav' => 'Top Navigation - Horizontal navigation bar',
            'minimal' => 'Minimal - Clean admin interface',
            'neo' => 'Neo - Modern futuristic admin',
            'classic' => 'Classic - Traditional admin panel',
        ]
    ]);
})->name('test.layouts');
