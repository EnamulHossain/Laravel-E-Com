<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login',function() {
    return view('admin.login');
})->name('admin.login');

Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    Route::get('dashboard',function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::resource('child_categories',ChildCategoryController::class);
    Route::resource('brand',BrandController::class);
});