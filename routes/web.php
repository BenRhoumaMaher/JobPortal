<?php

use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Jobs\JobsController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::controller(JobsController::class)->prefix('jobs')->group(function () {
    Route::get('/single/{job}', 'single')->name('single.job')->whereNumber('job');
    Route::post('/save', 'saveJob')->name('save.job');
    Route::post('/apply', 'jobApply')->name('apply.job');
    Route::any('/search', 'search')->name('search.job');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('/categories/{category:name}', 'singleCategory')->name('categories.single');
});

Route::controller(UsersController::class)->prefix('users')->group(function () {
    Route::get('/profile/{user:name}', 'profile')->name('profile');
    Route::get('/application', 'applications')->name('applications');
    Route::get('/savedJobs', 'savedJobs')->name('saved.jobs');
    Route::get('/edit-details/{user:name}', 'editDetails')->name('edit.details');
    Route::post('/{user}', 'updateDetails')->name('update.details');
});

Route::controller(AdminsController::class)->prefix('admins')->group(function () {
    Route::get('/login', 'viewLogin')->name('view.login');
    Route::post('/login', 'checkLogin')->name('check.login');
    Route::get('/', 'index')->name('admins.dashboard');
    Route::get('/all-admins', 'admins')->name('view.admins');
    Route::get('/create-admins', 'createAdmins')->name('create.admins');
    Route::post('/create-admins', 'storeAdmins')->name('store.admins');
    Route::get('/categories', 'categories')->name('admins.categories');
    Route::get('/create-categories', 'createCategories')->name('create.categories');
    Route::post('/store-categories', 'storeCategories')->name('store.categories');
    Route::get('/update-categories/{category}', 'editCategories')->name('edit.categories');
    Route::post('/update-categories/{category}', 'updateCategories')->name('update.categories');
    Route::post('/delete-categories/{category}', 'deleteCategories')->name('delete.categories');
    Route::get('/show-jobs', 'showJob')->name('show.jobs');
    Route::get('/create-jobs', 'createJobs')->name('create.jobs');
    Route::post('/store-jobs', 'storeJobs')->name('store.jobs');
    Route::post('/delete-jobs/{job}', 'deleteJob')->name('delete.jobs');
    Route::get('/show-applications', 'showApplications')->name('show.applications');
    Route::post('/delete-applications/{application}', 'deleteApplications')->name('delete.applications');
});
