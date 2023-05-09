<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicateController;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/application-success', [ApplicateController::class, 'Success'])->name('Success');


Route::get('/form/{category_slug}', [ApplicateController::class, 'formquestions'])->name('formquestions');

Route::post('savedform/{id}', [ApplicateController::class, 'applicationsave'])->name('applicationsave');


Route::middleware('auth')->group(function(){


    Route::group(['prefix' => 'applications'], function () {
        Route::get('list', [ApplicateController::class, 'ApplicationsList'])->name('ApplicationsList');
        Route::get('form-list', [ApplicateController::class, 'FormsList'])->name('FormsList');


        Route::get('create-form', [ApplicateController::class, 'CreateForm'])->name('CreateForm');
        Route::get('user-profile/{id}', [ApplicateController::class, 'ProfilePage'])->name('ApplicatedUserPage');
        Route::get('inspect-form/{id}', [ApplicateController::class, 'InspectForm'])->name('InspectApplicationForm');


        Route::get('download-file/{id}', [ApplicateController::class, 'downloadfile'])->name('downloadfile');
        Route::get('isnpect-file/{id}', [ApplicateController::class, 'inspectFile'])->name('inspectFile');


        Route::post('save/list', [ApplicateController::class, 'SaveForm'])->name('SaveForm');
        Route::post('save/newquestion/{id}', [ApplicateController::class, 'saveNewQuestion'])->name('saveNewQuestion');
        Route::post('update/question/{id}', [ApplicateController::class, 'UpdateQuestion'])->name('UpdateQuestion');
        Route::post('newstatus/{id}', [ApplicateController::class, 'newComment'])->name('newComment');
        Route::post('newcomment/{id}', [ApplicateController::class, 'newStatus'])->name('newStatus');
        Route::post('updateform/{id}', [ApplicateController::class, 'UpdateForm'])->name('UpdateForm');


        Route::get('destroyquestion/{id}', [ApplicateController::class, 'DestroyQuestion'])->name('DestroyQuestion');
        Route::get('destroyapplication/{id}', [ApplicateController::class, 'DestroyApplicant'])->name('DestroyApplicant');
        Route::get('destroyform/{id}', [ApplicateController::class, 'DestroyForm'])->name('DestroyForm');

    });


    Route::group(['prefix' => 'admin'], function () {
        Route::get('list', [CommonController::class, 'AdminList'])->name('AdminList');

        Route::post('newuser', [CommonController::class, 'newAdmin'])->name('newAdmin');
        Route::post('updat-user/{id}', [CommonController::class, 'editAdmin'])->name('editAdmin');


    });

    // Main Page Route
    Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');

});


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

