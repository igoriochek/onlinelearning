<?php

use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\SectionController as TeacherSectionController;
use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;
use App\Http\Controllers\Teacher\StepController as TeacherStepController;
use Illuminate\Support\Facades\Route;

Route::middleware('redirect.if.admin')->group(function () {
  Route::get('/', [HomeController::class, 'index'])->name('home');
  Route::get('/course/{course}', [CourseController::class, 'show'])->name(
    'courses.show',
  );
});
Route::get('/language/{locale?}', [LocaleController::class, 'change'])
  ->name('changeLanguage');

Route::middleware(['auth'])->group(function () {
  Route::post('/courses/{course}/enroll', [
    EnrollmentController::class,
    'store',
  ])
    ->middleware(['auth'])
    ->name('courses.enroll');

  Route::post('/courses/{course}/review', [ReviewController::class, 'store'])
    ->name('courses.review.store');
  Route::delete('/courses/reviews/{review}', [ReviewController::class, 'destroy'])
    ->name('courses.review.destroy');

  Route::get('/lesson/{lesson}/step/{position}', [
    LessonController::class,
    'show',
  ])->name('lessons.step.show');
  Route::post('/steps/{step}/submit', [StepController::class, 'submit'])->name(
    'lessons.step.submit',
  );
  Route::post('/steps/{step}/complete', [
    StepController::class,
    'completeStep',
  ])->name('lessons.step.complete');

  Route::prefix('dashboard')->middleware('redirect.if.admin')->group(function () {
    Route::get('/', function () {
      return view('dashboard.index');
    })->name('dashboard');
    Route::get('/my-courses', [DashboardController::class, 'myCourses'])->name(
      'dashboard.my-courses',
    );

    Route::get('/wishlist', [WishlistController::class, 'index'])->name(
      'dashboard.wishlist',
    );
    Route::get('/manage-courses', [
      DashboardController::class,
      'manageCourses',
    ])->name('dashboard.manage-courses');
    Route::post('/wishlist/{course}', [
      WishlistController::class,
      'store',
    ])->name('dashboard.wishlist.store');
    Route::delete('/wishlist/{course}', [
      WishlistController::class,
      'destroy',
    ])->name('dashboard.wishlist.destroy');
  });

  Route::prefix('teach')
    ->middleware('role:teacher')
    ->name('teacher.')
    ->group(function () {
      Route::resource('courses', TeacherCourseController::class)
        ->except(['index'])
        ->names('courses');
      Route::post('courses/{course}/publish', [
        TeacherCourseController::class,
        'publish',
      ])->name('courses.publish');

      Route::resource('courses.sections', TeacherSectionController::class)
        ->shallow()
        ->except(['show', 'edit', 'create']);

      Route::post('courses/{course}/sections/reorder', [
        TeacherSectionController::class,
        'reorder',
      ])->name('courses.sections.reorder');

      Route::resource('sections.lessons', TeacherLessonController::class)
        ->shallow()
        ->except(['show', 'edit', 'create']);

      Route::post('sections/{section}/lessons/reorder', [
        TeacherLessonController::class,
        'reorder',
      ])->name('sections.lessons.reorder');

      Route::resource('lessons.steps', TeacherStepController::class)
        ->shallow()
        ->except(['show']);

      Route::post('lessons/{lesson}/steps/reorder', [
        TeacherStepController::class,
        'reorder',
      ])->name('lessons.steps.reorder');
    });

  Route::prefix('admin')
    ->middleware('role:admin')
    ->name('admin.')
    ->group(function () {
      Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');
      Route::resource('users', UserController::class)->only(['index']);
      Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
      Route::patch('users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
      Route::resource('courses', AdminCourseController::class)->only(['index']);
      Route::get('/lesson/{lesson}/step/{position}', [
        AdminLessonController::class,
        'show',
      ])->name('courses.step.show');
      Route::patch('/courses/{course}/approve', [AdminCourseController::class, 'approve'])->name('courses.approve');
      Route::patch('/courses/{course}/reject', [AdminCourseController::class, 'reject'])->name('courses.reject');
      Route::resource('reviews', AdminReviewController::class);
    });

  Route::prefix('profile')
    ->name('profile.')
    ->group(function () {
      Route::get('/', [ProfileController::class, 'edit'])->name('edit');
      Route::patch('/', [ProfileController::class, 'update'])->name('update');
      Route::delete('/', [ProfileController::class, 'destroy'])->name(
        'destroy',
      );
    });
});

require __DIR__ . '/auth.php';
