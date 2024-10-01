<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Exam;

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
});
Route::get('/questions', function () {
    return view('questions');
});

Route::get('/exam', Exam::class)->name('exam');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
