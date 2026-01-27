<?php

use App\Http\Controllers\ExecutiveCouncilController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\When;

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('/about', \App\Livewire\About::class)->name('about');

Route::get('/history-culture', \App\Livewire\HistoryCulture::class)->name('history-culture');

Route::get('/artifact/{slug}', \App\Livewire\Artifact::class)->name('artifact');

Route::get('/executive-council', \App\Livewire\ExecutiveCouncil::class)->name('executive-council');

Route::get('/executive-council-members', \App\Livewire\ExecutiveCouncilMembers::class)->name('executive-council-members');

Route::get('/executive-council-member/{slug}', \App\Livewire\ExecutiveCouncilMember::class)->name('executive-council-member');

Route::get('/achievements', \App\Livewire\Achievements::class)->name('achievements');

Route::get('/achievement/{slug}', \App\Livewire\Achievement::class)->name('achievement');

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
