<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;


Route::middleware(['auth', 'admin'])->group(function () {
    // admin-only routes
        Route::get('/users', function () {
        return view('admin.users');
    });
    
    // User List
    Route::get('/users', [UserController::class,'index'])->name('admin.users.index');

    // User Create
    Route::get('/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class,'store'])->name('admin.users.store');

    // User Edit
    Route::get('/users/edit/{id}', [UserController::class,'edit'])->name('admin.users.edit');
    Route::put('/users/update/', [UserController::class,'update'])->name('admin.users.update');

    // User Delete
    Route::delete('/users/delete/{id}', [UserController::class,'destroy'])->name('admin.users.delete');
});

Route::middleware(['auth','admin'])->group(function () {

    
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');  
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });


    // courses 
    Route::get('/courses', [CourseController::class,'index'])->name('admin.courses.index');
    Route::get('/courses/create', [CourseController::class,'create'])->name('admin.courses.create');
    Route::post('/courses', [CourseController::class,'store'])->name('admin.courses.store');
    Route::get('/courses/{id}', [CourseController::class,'show'])->name('admin.courses.show');
    Route::get('/courses/{id}/edit', [CourseController::class,'edit'])->name('admin.courses.edit');
    Route::put('/courses/update', [CourseController::class,'update'])->name('admin.courses.update');
    Route::delete('/courses/{id}', [CourseController::class,'destroy'])->name('admin.courses.destroy');
    
    // enrollments
    Route::get('/enrollments', [EnrollmentController::class,'index'])->name('admin.enrollments.index');
    Route::get('/enrollments/create/{course_id}', [EnrollmentController::class,'create'])->name('admin.enrollments.create');
    Route::post('/enrollments/store', [EnrollmentController::class,'store'])->name('admin.enrollments.store');
    Route::get('/enrollments/{id}', [EnrollmentController::class,'show'])->name('admin.enrollments.show');
    Route::get('/enrollments/edit/{id}', [EnrollmentController::class,'edit'])->name('admin.enrollments.edit');
    Route::put('/enrollments/{id}', [EnrollmentController::class,'update'])->name('admin.enrollments.update');
    Route::delete('/enrollments/{id}', [EnrollmentController::class,'destroy'])->name('admin.enrollments.destroy');
    
    Route::get('/enrollments/suspended/{id}', [EnrollmentController::class,'suspended'])->name('admin.enrollments.suspended');
    Route::get('/enrollments/cancelled/{id}', [EnrollmentController::class,'cancelled'])->name('admin.enrollments.cancelled');
    Route::get('/enrollments/revoke/{id}', [EnrollmentController::class,'revoke'])->name('admin.enrollments.revoke');
        
});


?>