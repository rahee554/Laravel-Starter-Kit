<?php

use ArtflowStudio\StarterKit\Helpers\StarterKitHelper;
use Illuminate\Support\Facades\Route;

/**
 * Test routes for all authentication and admin layouts
 * These routes allow previewing all layout variations
 * 
 * All views are loaded from the StarterKit package directory
 */

// Authentication Layout Test Routes
Route::prefix('test/auth')->name('test.auth.')->group(function () {
    
    // Centered Layout
    Route::get('/centered', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.centered']);
    })->name('centered');
    
    // Split Screen Layout
    Route::get('/split', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.split']);
    })->name('split');
    
    // Minimal Layout
    Route::get('/minimal', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.minimal']);
    })->name('minimal');
    
    // Glass Morphism Layout
    Route::get('/glass', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.glass']);
    })->name('glass');
    
    // Particles.js Layout
    Route::get('/particles', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.particles']);
    })->name('particles');
    
    // Hero Layout
    Route::get('/hero', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.hero']);
    })->name('hero');
    
    // Modern Layout
    Route::get('/modern', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.modern']);
    })->name('modern');
    
    // 3D Layout
    Route::get('/3d', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.3d']);
    })->name('3d');
    
    // Premium Dark Layout
    Route::get('/premium-dark', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.premium-dark']);
    })->name('premium-dark');
    
    // Gradient Flow Layout
    Route::get('/gradient-flow', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.gradient-flow']);
    })->name('gradient-flow');
    
    // Clean Layout
    Route::get('/clean', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.clean']);
    })->name('clean');
    
    // Hero Grid Layout
    Route::get('/hero-grid', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.hero-grid']);
    })->name('hero-grid');
    
    // Sidebar Layout
    Route::get('/sidebar', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.sidebar']);
    })->name('sidebar');
    
    // Base Layout
    Route::get('/base', function () {
        return view('starterkit::auth.login', ['layout' => 'starterkit::layouts.starterkit.auth.base']);
    })->name('base');
});

// Admin Layout Test Routes
Route::prefix('test/admin')->name('test.admin.')->group(function () {
    
    // Sidebar Layout (Default)
    Route::get('/sidebar', function () {
        return view('starterkit::test.admin-demo', ['layout' => 'starterkit::layouts.starterkit.admin.sidebar']);
    })->name('sidebar');
    
    // Top Navigation Layout
    Route::get('/topnav', function () {
        return view('starterkit::test.admin-demo', ['layout' => 'starterkit::layouts.starterkit.admin.topnav']);
    })->name('topnav');
    
    // Minimal Layout
    Route::get('/minimal', function () {
        return view('starterkit::test.admin-demo', ['layout' => 'starterkit::layouts.starterkit.admin.minimal']);
    })->name('minimal');
    
    // Neo Layout (Modern/Future)
    Route::get('/neo', function () {
        return view('starterkit::test.admin-demo', ['layout' => 'starterkit::layouts.starterkit.admin.neo']);
    })->name('neo');
    
    // Classic Layout
    Route::get('/classic', function () {
        return view('starterkit::test.admin-demo', ['layout' => 'starterkit::layouts.starterkit.admin.classic']);
    })->name('classic');
});

// Layout Showcase - Overview of all layouts (from package)
Route::get('/test/layouts', function () {
    return view('starterkit::test.layout-showcase', [
        'auth_layouts' => StarterKitHelper::getAvailableAuthLayouts(),
        'admin_layouts' => StarterKitHelper::getAvailableAdminLayouts(),
    ]);
})->name('test.layouts');
