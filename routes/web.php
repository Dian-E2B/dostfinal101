<?php

use App\Http\Controllers\EmailViewController;
use App\Http\Controllers\SeiViewController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SeiQualifierviewController;

use App\Http\Controllers\SendMailController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//SEI
Route::get('/seilist', [SeiViewController::class, 'seiqualifierview'])->name('seilist');
Route::get('/seilist2', [SeiViewController::class, 'seipotientalqualifierview'])->name('seilist2');
Route::get('/sei/create', [SeiViewController::class, 'create'])->name('sei.create');
Route::post('/sei', [SeiViewController::class, 'store'])->name('sei.store');

//EMAILS
Route::get('/emails', [EmailViewController::class, 'emailstatusview'])->name('emails');
Route::get('sendmail', [SendMailController::class, 'index'])->name('sendmail');
Route::get('/emaileditor', [EmailViewController::class, 'emaileditorview'])->name('emaileditor');
Route::get('/partials.emailcontent', [EmailViewController::class, 'emailcontentview'])->name('partials.emailcontent');
//Email Save

Route::post('ckeditor/upload', [\App\Http\Controllers\EmailSaveController::class, 'upload'])->name('ckeditor.upload');
Route::post('/create', [\App\Http\Controllers\EmailSaveController::class, 'create'])->name('create');;


require __DIR__.'/auth.php';

require __DIR__.'/studentauth.php';

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth:student', 'verified'])->name('student.dashboard');