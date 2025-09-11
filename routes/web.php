<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Exam;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\AdminController;
// Uncomment when you need the email functionality
// use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuestionController;
use App\Models\Course;
use App\Models\Employee;
use App\Models\Employer;
use App\Models\Regulation;
use App\Models\Video;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Mail\TestMail;

Route::get( '/', function () {
    return view('index');
})->name('index');

// Language switching route
// Route::get('/language/{locale}', function ($locale) {
//     if (in_array($locale, ['en', 'ka'])) {
//         session(['locale' => $locale]);
//     }
//     return redirect()->back();
// })->name('language.switch');

Route::get('/home', function () {
    return view('index');
});
Route::get('/regulations', function () {
    $regulations = Regulation::all();
    return view('regulations', compact('regulations'));
})->name('regulations');
Route::get('/terms-and-conditions', function () {
    return view('terms_and_conditions');
})->name('terms-and-conditions');
Route::get('/privacy-policy', function () {
    return view('privacy_policy');
})->name('privacy-policy');
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/specialists', function () {
    return view('specialists');
})->name('specialists');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/mail', function () {
    try {
        Mail::mailer('smtp')->to('giorgibekurashvili@gmail.com')->send(new TestMail());
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        Log::error('Mail error: ' . $e->getMessage());
        return 'Error sending email: ' . $e->getMessage() . ' | Check logs for more details.';
    }
})->name('mail');


Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/questions', [AdminController::class, 'questions'])->name('admin.questions');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{userId}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/users/{userId}/subscription/edit', [AdminController::class, 'editSubscription'])->name('admin.subscription.edit');
    Route::put('/admin/users/{userId}/subscription/update', [AdminController::class, 'updateSubscription'])->name('admin.subscription.update');

    // Regulations
    Route::get('/admin/regulations', [AdminController::class, 'regulations'])->name('admin.regulations.regulations');
    Route::get('/admin/regulations/create', [AdminController::class, 'createRegulation'])->name('admin.regulations.create');
    Route::post('/admin/regulations/store', [AdminController::class, 'storeRegulation'])->name('admin.regulations.store');
    Route::get('/admin/regulations/{regulation}/edit', [AdminController::class, 'editRegulation'])->name('admin.regulations.edit');
    Route::patch('/admin/regulations/{regulation}/update', [AdminController::class, 'updateRegulation'])->name('admin.regulations.update');
    Route::delete('/admin/regulations/{regulation}', [AdminController::class, 'destroyRegulation'])->name('admin.regulations.destroy');

    // Pricing
    Route::get('/admin/plans', [AdminController::class, 'plans'])->name('admin.plans');
    Route::get('/admin/plans/create', [AdminController::class, 'createPlan'])->name('admin.plans.create');
    Route::post('/admin/plans/store', [AdminController::class, 'storePlan'])->name('admin.plans.store');
    Route::get('/admin/plans/{plan}/edit', [AdminController::class, 'editPlan'])->name('admin.plans.edit');
    Route::put('/admin/plans/{plan}/update', [AdminController::class, 'updatePlan'])->name('admin.plans.update');
    Route::delete('/admin/plans/{plan}', [AdminController::class, 'destroyPlan'])->name('admin.plans.destroy');

    Route::get('/admin/plan-types/create', [AdminController::class, 'createPlanType'])->name('admin.plan-types.create');
    Route::post('/admin/plan-types/store', [AdminController::class, 'storePlanType'])->name('admin.plan-types.store');
    Route::get('/admin/plan-types/{planType}/edit', [AdminController::class, 'editPlanType'])->name('admin.plan-types.edit');
    Route::put('/admin/plan-types/{planType}/update', [AdminController::class, 'updatePlanType'])->name('admin.plan-types.update');
    Route::delete('/admin/plan-types/{planType}', [AdminController::class, 'destroyPlanType'])->name('admin.plan-types.destroy');

    Route::get('/admin/plan-options/create', [AdminController::class, 'createPlanOption'])->name('admin.plan-options.create');
    Route::post('/admin/plan-options/store', [AdminController::class, 'storePlanOption'])->name('admin.plan-options.store');
    Route::get('/admin/plan-options/{planOption}/edit', [AdminController::class, 'editPlanOption'])->name('admin.plan-options.edit');
    Route::put('/admin/plan-options/{planOption}/update', [AdminController::class, 'updatePlanOption'])->name('admin.plan-options.update');
    Route::delete('/admin/plan-options/{planOption}', [AdminController::class, 'destroyPlanOption'])->name('admin.plan-options.destroy');

    // Questions
    Route::get('/admin/questions/create', [AdminController::class, 'create'])->name('admin.questions.create');
    Route::post('/admin/questions/store', [AdminController::class, 'store'])->name('admin.questions.store');
    Route::get('/admin/questions/{question}/edit/', [AdminController::class, 'edit'])->name('admin.questions.edit');
    Route::patch('/admin/questions/update/{question}', [AdminController::class, 'update'])->name('admin.questions.update');
    Route::delete('/admin/questions/destroy/{question}', [AdminController::class, 'destroy'])->name('admin.questions.destroy');

    // Codes
    Route::get('/admin/codes', [AdminController::class, 'codes'])->name('admin.codes');
    Route::delete('/admin/codes/destroy/{group}', [AdminController::class, 'destroyGroup'])->name('admin.codes.destroy');
    Route::get('/admin/codes/edit/{group}', [AdminController::class, 'editGroup'])->name('admin.codes.edit');
    Route::patch('/admin/codes/update/{group}', [AdminController::class, 'updateGroup'])->name('admin.codes.update');
    Route::get('/admin/codes/create', [AdminController::class, 'createGroup'])->name('admin.codes.create');
    Route::post('/admin/codes/store', [AdminController::class, 'storeGroup'])->name('admin.codes.store');

    // Courses
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/admin/courses/create', [AdminController::class, 'createCourse'])->name('admin.courses.create');
    Route::post('/admin/courses/store', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
    Route::get('/admin/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::patch('/admin/courses/{course}/update', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/admin/courses/{course}', [AdminController::class, 'destroyCourse'])->name('admin.courses.destroy');
    Route::get('/admin/courses/{course}/chapters', [AdminController::class, 'chapters'])->name('admin.courses.chapters');
    Route::get('/admin/courses/{course}/chapters/create', [AdminController::class, 'createChapter'])->name('admin.courses.chapters.create');
    Route::post('/admin/courses/{course}/chapters/store', [AdminController::class, 'storeChapter'])->name('admin.courses.chapters.store');
    Route::get('/admin/courses/{course}/chapters/{chapter}/edit', [AdminController::class, 'editChapter'])->name('admin.courses.chapters.edit');
    Route::patch('/admin/courses/{course}/chapters/{chapter}/update', [AdminController::class, 'updateChapter'])->name('admin.courses.chapters.update');
    Route::delete('/admin/courses/{course}/chapters/{chapter}', [AdminController::class, 'destroyChapter'])->name('admin.courses.chapters.destroy');
    Route::get('/admin/courses/{course}/chapters/{chapter}/videos', [AdminController::class, 'videos'])->name('admin.courses.chapters.videos');
    Route::get('/admin/courses/{course}/chapters/{chapter}/videos/create', [AdminController::class, 'createVideo'])->name('admin.courses.chapters.videos.create');
    Route::post('/admin/courses/{course}/chapters/{chapter}/videos/store', [AdminController::class, 'storeVideo'])->name('admin.courses.chapters.videos.store');
    Route::get('/admin/courses/{course}/chapters/{chapter}/videos/{video}/edit', [AdminController::class, 'editVideo'])->name('admin.courses.chapters.videos.edit');
    Route::patch('/admin/courses/{course}/chapters/{chapter}/videos/{video}/update', [AdminController::class, 'updateVideo'])->name('admin.courses.chapters.videos.update');
    Route::delete('/admin/courses/{course}/chapters/{chapter}/videos/{video}', [AdminController::class, 'destroyVideo'])->name('admin.courses.chapters.videos.destroy');
    Route::get('/admin/courses/{course}/chapters/{chapter}/videos/{video}', [AdminController::class, 'showVideo'])->name('admin.courses.chapters.videos.show');

    // Settings
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

    Route::get('/admin/certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
    Route::post('/admin/certificates/store', [CertificateController::class, 'store'])->name('admin.certificates.store');
    Route::get('/admin/certificates/{certificate}/edit', [CertificateController::class, 'edit'])->name('admin.certificates.edit');
    Route::put('/admin/certificates/{certificate}/update', [CertificateController::class, 'update'])->name('admin.certificates.update');
    Route::delete('/admin/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');

    // Posts
    Route::get('admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('admin/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('admin/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::patch('admin/posts/{post:slug}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('admin/posts/{post:slug}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    // Commercials
    Route::get('admin/commercials', [CommercialController::class, 'index'])->name('admin.commercials');
    Route::get('admin/commercials/create', [CommercialController::class, 'create'])->name('admin.commercials.create');
    Route::post('admin/commercials', [CommercialController::class, 'store'])->name('admin.commercials.store');
    Route::get('admin/commercials/{commercial}/edit', [CommercialController::class, 'edit'])->name('admin.commercials.edit');
    Route::patch('admin/commercials/{commercial}', [CommercialController::class, 'update'])->name('admin.commercials.update');
    Route::delete('admin/commercials/{commercial}', [CommercialController::class, 'destroy'])->name('admin.commercials.destroy');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'subscription','verified'])->group(function () {
    Route::get('/tutorials', function () {
        $courses = Course::all();
        $videos_ordered = Video::orderBy('weight')->get();
        return view('tutorials', compact('courses', 'videos_ordered'));
    })->name('tutorials');

    Route::get('/tutorials/course/{course}', function ($course) {
        $course = Course::find($course);
        return view('tutorials.chapters', compact('course'));
    })->name('tutorials.chapters');

    Route::get('/tutorials/video/{video}', function ($video) {
        $video = Video::findOrFail($video);
        
        // Get the chapter this video belongs to
        if (!$video->chapter) {
            abort(404, 'Video chapter not found');
        }
        $chapter = $video->chapter;
        
        // Get the course this chapter belongs to
        if (!$chapter->course) {
            abort(404, 'Chapter course not found');
        }
        $course = $chapter->course;
        
        // Get all videos in this chapter, ordered by weight
        $playlist = $chapter->videos()->orderBy('weight')->get();
        
        // Find current video index in playlist
        $currentIndex = $playlist->search(function($item) use ($video) {
            return $item->id === $video->id;
        });
        
        // Get next and previous videos
        $nextVideo = $currentIndex < $playlist->count() - 1 ? $playlist[$currentIndex + 1] : null;
        $previousVideo = $currentIndex > 0 ? $playlist[$currentIndex - 1] : null;
        
        return view('tutorials.show', compact('video', 'chapter', 'course', 'playlist', 'currentIndex', 'nextVideo', 'previousVideo'));
    })->name('tutorials.show');

    Route::get('/test_results', function () {
        return view('user.test_results');
    })->name('test_results');
    Route::get('/video', function () {
        return view('user.video');
    })->name('video');

    Route::get('/questions', [QuestionController::class, 'indexToUser'])->name('questions');
    Route::get('/result/{test}', [ResultController::class, 'index'])->name('result');
    Route::get('/exam/{examRequest}', Exam::class)->name('exam');
    Route::get('/test', Exam::class)->name('test');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.workspace');
    })->name('dashboard');
    Route::get('/workspace', function () {
        return view('user.workspace');
    })->name('workspace');
    
    Route::post('/exam/start', [App\Http\Controllers\ExamController::class, 'start'])->name('exam.start');


    Route::get('subscribe/{plan}', [PaymentController::class, 'buySubscription'])->name('subscribe.pay')->middleware('agreement');

    // Employer routes
    Route::get('/employers/create', [EmployerController::class, 'create'])->name('employers.create');
    Route::post('/employers', [EmployerController::class, 'store'])->name('employers.store');
    Route::get('/employers/{employer}', [EmployerController::class, 'show'])->name('employers.show');
    Route::get('/employers/{employer}/edit', [EmployerController::class, 'edit'])->name('employers.edit');
    Route::patch('/employers/{employer}', [EmployerController::class, 'update'])->name('employers.update');
    Route::delete('/employers/{employer}', [EmployerController::class, 'destroy'])->name('employers.destroy');

    // Employee routes
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::patch('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/certificated-specialists', [CertificateController::class, 'index'])->name('certificated-specialists');
Route::get('/certificated-specialists/{certificate}', [CertificateController::class, 'show'])->name('certificated-specialists.show');
Route::get('/jobs', function () {
    $employers = Employer::all();
    $employees = Employee::all();
    return view('jobs.jobs-listings', compact('employers', 'employees'));
})->name('jobs');

// Commented out email testing routes - Uncomment to test email functionality

// Test Email Routes
// Route::get('/send-test-email', [EmailTestController::class, 'sendTestEmail']);
// Route::get('/email-form', function() {
//     return view('emails.form');
// });
// Route::post('/send-custom-email', [EmailTestController::class, 'sendCustomEmail']);


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/test', function (\Illuminate\Http\Request $request) {
    return $request;
});

// Test route to clear agreement session
Route::get('/clear-agreement', function () {
    session()->forget('agreement_accepted');
    return redirect()->back()->with('message', 'Agreement session cleared');
})->name('clear.agreement');



Route::get('/mail', function () {
    Mail::to(request('mail'))->send(new \App\Mail\ZohoMail());
    return 'Email sent!';
});


