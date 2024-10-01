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