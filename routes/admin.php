<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['is_admin'])->group(function () {
    Route::get('check',function() {
        return view('admin.layout.app');
    })->name('check');
});