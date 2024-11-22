<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Exam;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
});
Route::get('/questions', function () {
    return view('questions');
});

Route::get('/result', [ResultController::class, 'index'])->name('result'); 

Route::get('/exam', Exam::class)->name('exam');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/admin/questions', [AdminController::class, 'questions'])->name('admin.questions');

Route::get('/admin/questions/create', [AdminController::class, 'create'])->name('admin.questions.create');

Route::post('/admin/questions/store', [AdminController::class, 'store'])->name('admin.questions.store');

Route::get('/admin/questions/{question}/edit/', [AdminController::class, 'edit'])->name('admin.questions.edit');

Route::put('/admin/questions/update/{question}', [AdminController::class, 'update'])->name('admin.questions.update');

Route::get('/admin/questions/destroy/{question}', [AdminController::class, 'destroy'])->name('admin.questions.destroy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('logout');