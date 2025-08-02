<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskShareController;
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
})->name('/');

// Chronione trasy — tylko dla zalogowanych
Route::middleware('auth')->group(function () {
    // Zadania
    Route::resource('tasks', TaskController::class)->names('tasks');

    // Udostępnianie zadań (generowanie linku)
    Route::post('tasks/{task}/share', [TaskShareController::class, 'generate'])->name('tasks.share');
    
});

// Link publiczny do podglądu zadania
Route::get('shared/{token}', [TaskShareController::class, 'show'])->name('tasks.shared.show');

// Wbudowane routy auth (login, register, itp.)
require __DIR__.'/auth.php';
