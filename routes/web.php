<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'courses']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/courses/{id}', [CourseController::class,'show'])->name('courses.show');

Route::get('/enrollments/enroll/{course_id}', [EnrollmentController::class,'enroll'])->name('enrollments.enroll');
Route::get('/enrollments/unroll/{id}', [EnrollmentController::class,'unenroll'])->name('enrollments.unroll');
Route::get('/enrollments/mycourses/', [HomeController::class,'mycourses'])->name('enrollments.mycourses');