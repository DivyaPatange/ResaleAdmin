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
use App\Http\Controllers\Admin\DeletePostController;
use App\Http\Controllers\Admin\ViewPostController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\BrandModelController;
use App\Http\Controllers\Admin\CommercialCarVarientController;

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
    Route::get('/post-ad-users', [UsersController::class, 'showList'])->name('post-ad-users');
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
    Route::get('/sub-category/{cid}/{sid}', [SubCategoryController::class, 'getSubCategoryView'])->name('subCategoryView');
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

    // commercial vehicle car varient route
    Route::get('/commercial/car-varient/{id}', [CommercialCarVarientController::class, 'commercialCarVarient'])->name('commercial-car-varient');
    Route::post('/get-commercial-car-varient', [CommercialCarVarientController::class, 'getCommercialCarVarient'])->name('get.commercial-car-varient');
    Route::post('/commercial-car-varient/update', [CommercialCarVarientController::class, 'updateCommercialCarVarient']);
    Route::get('/get-brand-model-list', [CommercialCarVarientController::class, 'getBrandModelList']);

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

    // Brand Model Route
    Route::resource('/brand-model', BrandModelController::class);
    Route::get('/subCategory/brand-model/{id}', [BrandModelController::class, 'subCategoryBrandModel'])->name('brand-model');
    Route::post('/get-brand-model', [BrandModelController::class, 'getBrandModel'])->name('get.brand-model');
    Route::post('/brand-model/update', [BrandModelController::class, 'updateBrandModel']);

    // Delete Post Route
    Route::delete('/deleteCarPost/{id}', [DeletePostController::class, 'deleteCarPost'])->name('deleteCarPost');
    Route::delete('/deleteComVehiclePost/{id}', [DeletePostController::class, 'deleteComVehiclePost'])->name('deleteComVehiclePost');
    Route::delete('/deleteSparePartPost/{id}', [DeletePostController::class, 'deleteSparePartPost'])->name('deleteSparePartPost');
    Route::delete('/deleteMobilePhonePost/{id}', [DeletePostController::class, 'deleteMobilePhonePost'])->name('deleteMobilePhonePost');
    Route::delete('/deleteMobileAccessoryPost/{id}', [DeletePostController::class, 'deleteMobileAccessoryPost'])->name('deleteMobileAccessoryPost');
    Route::delete('/deleteMobileTabletPost/{id}', [DeletePostController::class, 'deleteMobileTabletPost'])->name('deleteMobileTabletPost');
    Route::delete('/deleteJobPost/{id}', [DeletePostController::class, 'deleteJobPost'])->name('deleteJobPost');
    Route::delete('/deleteBikePost/{id}', [DeletePostController::class, 'deleteBikePost'])->name('deleteBikePost');
    Route::delete('/deleteElectronicPost/{id}', [DeletePostController::class, 'deleteElectronicPost'])->name('deleteElectronicPost');
    Route::delete('/deleteFurniturePost/{id}', [DeletePostController::class, 'deleteFurniturePost'])->name('deleteFurniturePost');
    Route::delete('/deleteFashionPost/{id}', [DeletePostController::class, 'deleteFashionPost'])->name('deleteFashionPost');
    Route::delete('/deleteEducationPost/{id}', [DeletePostController::class, 'deleteEducationPost'])->name('deleteEducationPost');
    Route::delete('/deletePetPost/{id}', [DeletePostController::class, 'deletePetPost'])->name('deletePetPost');

    // View Post Route
    Route::get('/viewCarPost/{id}', [ViewPostController::class, 'viewCarPost'])->name('viewCarPost');
    Route::get('/viewCommercialVehiclePost/{id}', [ViewPostController::class, 'viewComVehiclePost'])->name('viewComVehiclePost');
    Route::get('/viewSparePartPost/{id}', [ViewPostController::class, 'viewSparePartPost'])->name('viewSparePartPost');
    Route::get('/viewMobilePhonePost/{id}', [ViewPostController::class, 'viewMobilePhonePost'])->name('viewMobilePhonePost');
    Route::get('/viewMobileAccessoryPost/{id}', [ViewPostController::class, 'viewMobileAccessoryPost'])->name('viewMobileAccessoryPost');
    Route::get('/viewMobileTabletPost/{id}', [ViewPostController::class, 'viewMobileTabletPost'])->name('viewMobileTabletPost');
    Route::get('/viewJobPost/{id}', [ViewPostController::class, 'viewJobPost'])->name('viewJobPost');
    Route::get('/viewBikePost/{id}', [ViewPostController::class, 'viewBikePost'])->name('viewBikePost');
    Route::get('/viewElectronicPost/{id}', [ViewPostController::class, 'viewElectronicPost'])->name('viewElectronicPost');
    Route::get('/viewFurniturePost/{id}', [ViewPostController::class, 'viewFurniturePost'])->name('viewFurniturePost');
    Route::get('/viewFashionPost/{id}', [ViewPostController::class, 'viewFashionPost'])->name('viewFashionPost');
    Route::get('/viewEducationPost/{id}', [ViewPostController::class, 'viewEducationPost'])->name('viewEducationPost');
    Route::get('/viewPetPost/{id}', [ViewPostController::class, 'viewPetPost'])->name('viewPetPost');

    Route::get('/display-ad/{id}', [SubCategoryController::class, 'displayAd'])->name('display-ad');

    Route::resource('/rate-card', RateController::class);
});
