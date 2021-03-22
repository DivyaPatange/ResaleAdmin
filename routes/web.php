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
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubRoleController;
use App\Http\Controllers\Admin\SizeController;

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
    Route::resource('/users', UsersController::class);
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
    Route::get('/sub-category/{cid}/{sid}', [SubCategoryController::class, 'getSubCategoryView']);
    // sub-category brand route
    Route::post('/get-brand', [BrandController::class, 'getBrand'])->name('get.brand');
    Route::post('/brand/update', [BrandController::class, 'updateBrand']);
    Route::get('/subCategory/brand/{id}', [BrandController::class, 'subCategoryBrand'])->name('brand');

    // sub-category model route
    Route::get('/subCategory/model/{id}', [ModelController::class, 'subCategoryModel'])->name('model');
    Route::post('/get-model', [ModelController::class, 'getModel'])->name('get.model');
    Route::post('/model/update', [ModelController::class, 'updateModel']);

    // sub-category car varient route
    Route::get('/subCategory/car-varient/{id}', [CarVarientController::class, 'subCategoryCarVarient'])->name('car-varient');
    Route::post('/get-car-varient', [CarVarientController::class, 'getCarVarient'])->name('get.car-varient');
    Route::post('/car-varient/update', [CarVarientController::class, 'updateCarVarient']);

    // sub-category type route
    Route::get('/subCategory/type/{id}', [TypeController::class, 'subCategoryType'])->name('type');
    Route::post('/get-type', [TypeController::class, 'getType'])->name('get.type');
    Route::post('/type/update', [TypeController::class, 'updateType']);

    // sub-category type brand route
    Route::get('/subCategory/type-brand/{id}', [TypeBrandController::class, 'subCategoryTypeBrand'])->name('type-brand');
    Route::post('/get-type-brand', [TypeBrandController::class, 'getTypeBrand'])->name('get.type-brand');
    Route::post('/type-brand/update', [TypeBrandController::class, 'updateTypeBrand']);

    // Role Route
    Route::resource('/role', RoleController::class);
    Route::get('/subCategory/role/{id}', [RoleController::class, 'subCategoryRole'])->name('role');
    Route::post('/get-role', [RoleController::class, 'getRole'])->name('get.role');
    Route::post('/role/update', [RoleController::class, 'updateRole']);

     // Size Route
     Route::resource('/size', SizeController::class);
     Route::get('/subCategory/size/{id}', [SizeController::class, 'subCategorySize'])->name('size');
     Route::post('/get-size', [SizeController::class, 'getSize'])->name('get.size');
     Route::post('/size/update', [SizeController::class, 'updateSize']);

    // Sub Role Route
    Route::resource('/subrole', SubRoleController::class);
    Route::get('/subCategory/subrole/{id}', [SubRoleController::class, 'subCategorySubrole'])->name('subrole');
    Route::post('/get-subrole', [SubRoleController::class, 'getSubrole'])->name('get.subrole');
    Route::post('/subrole/update', [SubRoleController::class, 'updateSubrole']);
});
