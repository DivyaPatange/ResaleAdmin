<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SuggestionController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\CategoryFormFieldController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\TypeBrandController;
use App\Http\Controllers\Admin\LocalityController;
use App\Http\Controllers\Admin\CarVarientController;

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

Route::get('/', function () {
    return view('admin.login');
})->name('front');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::resource('/category', CategoryController::class);
    Route::resource('/sub-category', SubCategoryController::class);
    Route::resource('/suggestion', SuggestionController::class);
    Route::get('get-subcategory-list', [SuggestionController::class, 'getSubCategoryList']);
    Route::resource('/brands', BrandController::class);
    Route::resource('/types', TypeController::class);
    Route::resource('/model-name', ModelController::class);
    Route::get('/form-field', [CategoryFormFieldController::class, 'index'])->name('category.createField');
    Route::post('/store-form-field', [CategoryFormFieldController::class, 'store'])->name('createField.store');
    Route::get('get-brand-list', [ModelController::class, 'getBrandList']);
    Route::resource('/states', StateController::class);
    Route::resource('/city', CityController::class);
    Route::resource('/type-brand', TypeBrandController::class);
    Route::resource('/locality', LocalityController::class);
    Route::resource('/car-varient', CarVarientController::class);
    Route::get('/get-sub-brand-list', [CarVarientController::class, 'getSubBrandList']);
    Route::get('/get-sub-model-list', [CarVarientController::class, 'getSubModelList']);
    Route::get('/get-city-list', [LocalityController::class, 'getCityList']);
    Route::resource('/car-varient', CarVarientController::class);
});
