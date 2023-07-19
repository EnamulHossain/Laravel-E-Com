<?php

use Illuminate\Support\Facades\Route;

Route::get('admin/login',function() {
    return view('admin.login');
})->name('admin.login');

Route::middleware(['is_admin'])->prefix('admin')->group(function () {
    Route::get('dashboard',function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});