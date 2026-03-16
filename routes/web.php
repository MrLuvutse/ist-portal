<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['register' => false]);

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',          [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/students',           [AdminController::class, 'students'])->name('students');
    Route::get('/students/create',    [AdminController::class, 'createStudent'])->name('students.create');
    Route::post('/students',          [AdminController::class, 'storeStudent'])->name('students.store');
    Route::get('/students/{id}/edit', [AdminController::class, 'editStudent'])->name('students.edit');
    Route::put('/students/{id}',      [AdminController::class, 'updateStudent'])->name('students.update');
    Route::delete('/students/{id}',   [AdminController::class, 'deleteStudent'])->name('students.delete');
    Route::get('/courses',            [AdminController::class, 'courses'])->name('courses');
    Route::post('/courses',           [AdminController::class, 'storeCourse'])->name('courses.store');
    Route::delete('/courses/{id}',    [AdminController::class, 'deleteCourse'])->name('courses.delete');
    Route::get('/enrollments',        [AdminController::class, 'enrollments'])->name('enrollments');
    Route::post('/enrollments',       [AdminController::class, 'storeEnrollment'])->name('enrollments.store');
    Route::get('/grades',             [AdminController::class, 'grades'])->name('grades');
    Route::post('/grades',            [AdminController::class, 'storeGrade'])->name('grades.store');
    Route::get('/attendance',         [AdminController::class, 'attendance'])->name('attendance');
    Route::post('/attendance',        [AdminController::class, 'storeAttendance'])->name('attendance.store');
});

// Student routes
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard',    [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses',      [StudentController::class, 'courses'])->name('courses');
    Route::get('/grades',       [StudentController::class, 'grades'])->name('grades');
    Route::get('/attendance',   [StudentController::class, 'attendance'])->name('attendance');
});