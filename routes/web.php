<?php

use App\Http\Controllers\GuestNoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('guest-notes.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Guest Notes Routes
Route::get('/guest-notes', [GuestNoteController::class, 'index'])->name('guest-notes.index');
Route::post('/guest-notes', [GuestNoteController::class, 'store'])->name('guest-notes.store');
Route::delete('/guest-notes/{id}', [GuestNoteController::class, 'destroy'])->name('guest-notes.destroy');

// Priority Update Route
Route::post('/guest-notes/{id}/priority', [GuestNoteController::class, 'updatePriority'])
    ->name('guest-notes.priority');

require __DIR__.'/auth.php';
