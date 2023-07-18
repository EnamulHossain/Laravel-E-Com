<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['is_admin'])->group(function () {
    Route::get('check',function() {
        echo "admin";
    })->name('check');
});