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

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/tutorials', function () {
    return view('tutorials');
})->name('tutorials');

Route::get('/tutorials/{video}', function ($video) {
    // You might want to validate the video ID here
    return view('tutorials.show', compact('video'));
})->name('tutorials.show');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    Route::get('/admin/questions', [AdminController::class, 'questions'])->name('admin.questions');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/admin/codes', [AdminController::class, 'codes'])->name('admin.codes');

    Route::get('/admin/videos', [AdminController::class, 'videos'])->name('admin.videos');
    
    Route::get('/admin/questions/create', [AdminController::class, 'create'])->name('admin.questions.create');
    
    Route::post('/admin/questions/store', [AdminController::class, 'store'])->name('admin.questions.store');
    
    Route::get('/admin/questions/{question}/edit/', [AdminController::class, 'edit'])->name('admin.questions.edit');
    
    Route::patch('/admin/questions/update/{question}', [AdminController::class, 'update'])->name('admin.questions.update');
    
    Route::delete('/admin/questions/destroy/{question}', [AdminController::class, 'destroy'])->name('admin.questions.destroy');

    Route::delete('/admin/codes/destroy/{group}', [AdminController::class, 'destroyGroup'])->name('admin.codes.destroy');

    Route::get('/admin/codes/edit/{group}', [AdminController::class, 'editGroup'])->name('admin.codes.edit');

    Route::patch('/admin/codes/update/{group}', [AdminController::class, 'updateGroup'])->name('admin.codes.update');

    Route::get('/admin/codes/create', [AdminController::class, 'createGroup'])->name('admin.codes.create');

    Route::post('/admin/codes/store', [AdminController::class, 'storeGroup'])->name('admin.codes.store');
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

Route::get('/certificated-specialists', function () {
    return view('certificated-specialists');
})->name('certificated-specialists');

Route::get('/jobs', function () {
    return view('jobs.jobs-listings');
})->name('jobs');

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('logout');