<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/course/{course}', [CourseController::class, 'show'])->name(
	'courses.show',
);

Route::middleware(['auth', 'verified'])->group(function () {
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

	Route::prefix('dashboard')->group(function () {
		Route::get('/', function () {
			return view('dashboard.index');
		})->name('dashboard');
		Route::get('/wishlist', [WishlistController::class, 'index'])->name(
			'dashboard.wishlist',
		);
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
		->name('teacher.')
		->group(function () {
			Route::get('courses/create', [
				TeacherCourseController::class,
				'create',
			])->name('courses.create');
			Route::post('courses/store', [
				TeacherCourseController::class,
				'store',
			])->name('courses.store');
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
