<?php

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

//ROUTING AUTH
Route::get('/scholars/scholardashboard', 'ScholarController@dashboard')->middleware('role:2');

//SEI
Route::get('/seilist', [App\Http\Controllers\SeiQualifierviewController::class, 'index'])->name('seilist');
Route::get('/seilist2', [App\Http\Controllers\SeiPotentialQualifierviewController::class, 'index'])->name('seilist2');
Route::get('/sei/create', [SeiQualifierviewController::class, 'create'])->name('sei.create');
Route::post('/sei', [SeiQualifierviewController::class, 'store'])->name('sei.store');

//EMAILS
Route::get('/emails', [\App\Http\Controllers\EmailStatusViewController::class, 'index'])->name('emails');
Route::get('sendmail', [SendMailController::class, 'index'])->name('sendmail');
Route::get('/emaileditor', [\App\Http\Controllers\EmailEditorViewController::class, 'index'])->name('emaileditor');
Route::get('/partials.emailcontent', [App\Http\Controllers\EmailContentViewController::class, 'index'])->name('index');
//Email Save
//Route::post('/save-html-content', [\App\Http\Controllers\EmailSaveController::class, 'storeHTMLContent'])->name('save.html.content');
Route::post('ckeditor/upload', [\App\Http\Controllers\EmailSaveController::class, 'upload'])->name('ckeditor.upload');
Route::post('/create', [\App\Http\Controllers\EmailSaveController::class, 'create'])->name('create');;
//Route::get('/show', [EmailSaveController::class, 'show']);

require __DIR__.'/auth.php';
