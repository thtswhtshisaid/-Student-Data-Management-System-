<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\InternshipsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PublicationsController;

Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Achievements Routes
Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements'); // Show achievements page
Route::post('/achievements/upload', [AchievementsController::class, 'upload'])->name('achievements.upload'); // Handle file upload
Route::get('/achievements/{id}/edit', [AchievementsController::class, 'edit'])->name('achievements.edit');
Route::patch('/achievements/{id}', [AchievementsController::class, 'update'])->name('achievements.update');
Route::delete('/achievements/{id}', [AchievementsController::class, 'destroy'])->name('achievements.destroy');


// Other Pages Routes
Route::get('/internships', [InternshipsController::class, 'index'])->name('internships');
Route::post('/internships/upload', [InternshipsController::class, 'upload'])->name('internships.upload'); // Handle file upload
Route::get('/internships/{id}/edit', [InternshipsController::class, 'edit'])->name('internships.edit');
Route::patch('/internships/{id}', [InternshipsController::class, 'update'])->name('internships.update');
Route::delete('/internships/{id}', [InternshipsController::class, 'destroy'])->name('internships.destroy');



Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::post('/courses/upload', [CoursesController::class, 'upload'])->name('courses.upload');
Route::get('/courses/{id}/edit', [CoursesController::class, 'edit'])->name('courses.edit');
Route::patch('/courses/{id}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('/courses/{id}', [CoursesController::class, 'destroy'])->name('courses.destroy');


Route::get('/publications', [PublicationsController::class, 'index'])->name('publications');
Route::post('/publications/upload', [PublicationsController::class, 'upload'])->name('publications.upload');
Route::get('/publications/{id}/edit', [PublicationsController::class, 'edit'])->name('publications.edit');
Route::patch('/publications/{id}', [PublicationsController::class, 'update'])->name('publications.update');
Route::delete('/publications/{id}', [PublicationsController::class, 'destroy'])->name('publications.destroy');


require __DIR__.'/auth.php';
