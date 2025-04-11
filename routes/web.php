<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('user-dashboard',[UserController::class,'user'])->name('user-dashboard');

    Route::get('group',function(){
        return view('group');
    })->name('group');

    Route::get('view-group',function(){
        return view('view-group');
    })->name('view-group');

    Route::get('group-view/{id}',function ($id){
        return view('group-view',compact('id'));
    })->name('group-view');

    Route::get('group-edit/{id}',function ($id){
        return view('group-edit',compact('id'));
    })->name('group-edit');

    Route::get('inventory',function(){
        return view('inventory');
    })->name('inventory');

    Route::get('alarm',function(){
        return view('alarm');
    })->name('alarm');


    Route::get('admin-view',function(){
        return view('admin-view');
    })->name('admin-view');

    Route::get('/profile-view/{id}', function ($id) { //ดูข้อมูลโปรไฟล์
        return view('project.view', compact('id'));
    })->name('profile-view');

    Route::get('/profile-edit/{id}', function ($id) { //แก้ไขข้อมูลโปรไฟล์
        return view('project.edit', compact('id'));
    })->name('profile-edit');
});

require __DIR__.'/auth.php';
