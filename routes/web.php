<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskShareController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

// Route do ładowania części widoków formularzy auth (login, register, reset)
Route::get('/auth/partial/{type}', function ($type) {
    if (!in_array($type, ['login', 'register', 'reset'])) abort(404);
    return view("auth.partials.$type");
});

// Startowa strona — jeśli zalogowany, przekieruj do tasks
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    }
    return view('welcome');
});

// Dashboard (opcjonalnie)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Chronione trasy — tylko dla zalogowanych
Route::middleware('auth')->group(function () {
    // Zadania
    Route::resource('tasks', TaskController::class);

    // Udostępnianie zadań (generowanie linku)
    Route::post('tasks/{task}/share', [TaskShareController::class, 'generate'])->name('tasks.share');
    
    Route::get('/tasks/{task}/row', [TaskController::class,
    'row'])->name('tasks.row');

    // Profil użytkownika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Link publiczny do podglądu zadania
Route::get('shared/{token}', [TaskShareController::class, 'show'])->name('tasks.shared.show');

// Wbudowane routy auth (login, register, itp.)
require __DIR__.'/auth.php';
