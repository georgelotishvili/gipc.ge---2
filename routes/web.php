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
})->name('questions');
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/specialists', function () {
    return view('specialists');
})->name('specialists');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    Route::get('/admin/questions', [AdminController::class, 'questions'])->name('admin.questions');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/admin/videos', [AdminController::class, 'videos'])->name('admin.videos');
    
    Route::get('/admin/questions/create', [AdminController::class, 'create'])->name('admin.questions.create');
    
    Route::post('/admin/questions/store', [AdminController::class, 'store'])->name('admin.questions.store');
    
    Route::get('/admin/questions/{question}/edit/', [AdminController::class, 'edit'])->name('admin.questions.edit');
    
    Route::put('/admin/questions/update/{question}', [AdminController::class, 'update'])->name('admin.questions.update');
    
    Route::get('/admin/questions/destroy/{question}', [AdminController::class, 'destroy'])->name('admin.questions.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.workspace');
    })->name('dashboard');
    Route::get('/workspace', function () {
        return view('user.workspace');
    })->name('workspace');
    Route::get('/certificates', function () {
        return view('user.certificates');
    })->name('certificates');
    Route::get('/video', function () {
        return view('user.video');
    })->name('video');

    Route::get('/result/{test}', [ResultController::class, 'index'])->name('result');

    Route::get('/exam', Exam::class)->name('exam');

    Route::get('/test', Exam::class)->name('test');
});

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('logout');