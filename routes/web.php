<?php

use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\RsvpController;
use Illuminate\Support\Facades\Route;

// Public Invitation Routes
Route::get('/', [RsvpController::class, 'showInvitation'])->name('invitation.index');
Route::get('/to/{slug}', [RsvpController::class, 'showInvitation'])->name('invitation.guest');

Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
Route::get('/rsvp/wishes', [RsvpController::class, 'wishes'])->name('rsvp.wishes');
Route::post('/guest/{guest}/open', [RsvpController::class, 'markOpened'])->name('guest.open');

// Admin Dashboard Routes
Route::redirect('/admin', '/admin/guests');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::post('/guests', [GuestController::class, 'store'])->name('guests.store');
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');
    Route::post('/settings/photos', [GuestController::class, 'updatePhotos'])->name('settings.photos');
    Route::post('/settings/countdown', [GuestController::class, 'updateCountdown'])->name('settings.countdown');
});
