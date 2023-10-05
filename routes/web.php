<?php

use App\Http\Controllers\EmailViewController;
use App\Http\Controllers\SeiViewController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentViewController;
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

//ACCESSCONTROL
Route::get('/accesscontrol', [\App\Http\Controllers\AccessControlViewController::class, 'index'])->name('accesscontrol');
Route::get('/accesscontrolongoing', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolongoingview'])->name('accesscontrolongoing');
Route::get('/accesscontrolpending', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolpendingview'])->name('accesscontrolpending');
Route::get('/accesscontrolenrolled', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolenrolledview'])->name('accesscontrolenrolled');
Route::get('/accesscontroldeferred', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontroldeferredview'])->name('accesscontroldeferred');
Route::get('/accesscontrolLOA', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolLOAview'])->name('accesscontrolLOA');
Route::get('/accesscontrolterminated', [\App\Http\Controllers\AccessControlViewController::class, 'accesscontrolterminatedview'])->name('accesscontrolterminated');


//RSMS
Route::get('/rsms', [\App\Http\Controllers\AccessControlViewController::class, 'index'])->name('rsms');




require __DIR__.'/auth.php';

require __DIR__.'/studentauth.php';

//Route::get('/student/dashboard', function () {
//    return view('student.dashboard');
//})->middleware(['auth:student', 'verified'])->name('student.dashboard');

Route::get('/student/dashboard', [StudentViewController::class, 'index'])
    ->middleware(['auth:student', 'verified'])
    ->name('student.dashboard');

Route::get('/student/replyslipview', [StudentViewController::class, 'replyslipview'])
    ->middleware(['auth:student', 'verified'])
    ->name('student.replyslipview');


Route::post('replyslipsubmit', [\App\Http\Controllers\StudentActionsController::class, 'replyslipsave'])
    ->middleware(['auth:student', 'verified'])
    ->name('replyslipsubmit');

