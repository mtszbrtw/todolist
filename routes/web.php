<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskShareController;
use App\Http\Controllers\ProfileController;

// Startowa strona przekierowuje na listę zadań
Route::get('/', function () {
    return redirect()->route('tasks.index');
});


// Dashboard — jeśli chcesz zostawić
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Sekcja chroniona — tylko dla zalogowanych
Route::middleware('auth')->group(function () {

    // Taski
    Route::resource('tasks', TaskController::class);

    // Udostępnianie zadań
    Route::post('tasks/{task}/share', [TaskShareController::class, 'generate'])->name('tasks.share');

    // Profil użytkownika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Udostępniony link publiczny (bez auth)
Route::get('shared/{token}', [TaskShareController::class, 'show'])->name('tasks.shared.show');

// Auth routes
require __DIR__.'/auth.php';
