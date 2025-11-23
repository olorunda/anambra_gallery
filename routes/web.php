<?php

use App\Http\Controllers\ExecutiveCouncilController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\When;

Route::get('/', function () {
    $page = \App\Models\Page::where('slug', 'welcome')->where('is_active', true)->first();
    return view('welcome', compact('page'));
})->name('home');

Route::get('/about', function () {
    $page = \App\Models\Page::where('slug', 'about')->where('is_active', true)->first();
    return view('about', compact('page'));
})->name('about');

Route::get('/history-culture', function () {
    $artifacts = \App\Models\Artifact::with('images')->where('is_active', true)->orderBy('sort_order')->simplePaginate(6);
    $total_count = \App\Models\Artifact::count();
    return view('history-culture', compact('artifacts', 'total_count'));
})->name('history-culture');

Route::get('/artifact/{slug}', function ($slug) {
    $artifact = \App\Models\Artifact::with('images')->where('slug', $slug)->where('is_active', true)->firstOrFail();
    return view('artifact', compact('artifact'));
})->name('artifact');

Route::get('/executive-council', function () {
    $governor = \App\Models\CouncilMember::where('position', 'Governor')->where('is_active', true)->first();
    return view('executive-council', compact('governor'));
})->name('executive-council');

Route::get('/executive-council-members', [ExecutiveCouncilController::class, 'members'])->name('executive-council-members');

Route::get('/executive-council-member/{slug}', [ExecutiveCouncilController::class, 'show'])->name('executive-council-member');

Route::get('/achievements', function () {
    $achievements = \App\Models\Achievement::with('images')->where('is_active', true)->orderBy('sort_order')->paginate(6);
    $total_count = \App\Models\Achievement::count();
    return view('achievements', compact('achievements', 'total_count'));
})->name('achievements');

Route::get('/achievement/{slug}', function ($slug) {
    $achievement = \App\Models\Achievement::with('images')->where('slug', $slug)->where('is_active', true)->firstOrFail();
    return view('achievement', compact('achievement'));
})->name('achievement');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    // Admin Panel Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Pages Management
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class);

        // Executive Council Members Management
        Route::resource('executive-council-members', App\Http\Controllers\Admin\ExecutiveCouncilMemberController::class);

        // Artifacts Management
        Route::resource('artifacts', App\Http\Controllers\Admin\ArtifactController::class);

        // Achievements Management
        Route::resource('achievements', App\Http\Controllers\Admin\AchievementController::class);

        // Council Members Management
        Route::resource('council-members', App\Http\Controllers\Admin\CouncilMemberController::class);

        // Settings Management
        Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
