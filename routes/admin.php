<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SmtpController;
use App\Http\Controllers\Admin\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login',function() {
    return view('admin.login');
})->name('admin.login');

Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    Route::get('dashboard',function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Category
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::resource('child_categories',ChildCategoryController::class);
    Route::resource('brand',BrandController::class);

    //Setting
    Route::group(['prifix'=> 'setting'],function(){
        // Route::resource('seo',SeoController::class);
        Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
        Route::post('seo/{seo}', [SeoController::class, 'update'])->name('seo.update');
        Route::get('smtp', [SmtpController::class, 'index'])->name('smtp.index');
        Route::post('smtp/{smtp}', [SmtpController::class, 'update'])->name('smtp.update');
        Route::resource('website',WebsiteController::class);
        Route::resource('page',PageController::class);
        Route::resource('payment',PaymentController::class);
    });
});