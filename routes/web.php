<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\LatesController;
use App\Http\Controllers\TampilData;

Route::middleware('IsGuest')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
});

Route::post('login-auth', [UsersController::class, 'loginAuth'])->name('login.auth');

Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/home', [TampilData::class, 'index'])->name('home');
    Route::get('/home-ps', [TampilData::class, 'indexSiswa'])->name('homePs');


    Route::middleware('IsAdmin')->group(function () {
        Route::prefix('/rombels')->name('rombels.')->group(function () {
            Route::get('/', [RombelsController::class, 'index'])->name('index');
            Route::get('/create', [RombelsController::class, 'create'])->name('create');
            Route::post('/store', [RombelsController::class, 'store'])->name('store');
            Route::get('/edit/{rombel}', [RombelsController::class, 'edit'])->name('edit');
            Route::patch('/update/{rombel}', [RombelsController::class, 'update'])->name('update');
            Route::delete('/delete/{rombel}', [RombelsController::class, 'delete'])->name('delete');
        });

        Route::prefix('/rayons')->name('rayons.')->group(function () {
            Route::get('/', [RayonsController::class, 'index'])->name('index');
            Route::get('/create', [RayonsController::class, 'create'])->name('create');
            Route::post('/store', [RayonsController::class, 'store'])->name('store');
            Route::get('/edit/{rayon}', [RayonsController::class, 'edit'])->name('edit');
            Route::patch('/update/{rayon}', [RayonsController::class, 'update'])->name('update');
            Route::delete('/delete/{rayon}', [RayonsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/students')->name('students.')->group(function () {
            Route::get('/', [StudentsController::class, 'index'])->name('index');
            Route::get('/create', [StudentsController::class, 'create'])->name('create');
            Route::post('/store', [StudentsController::class, 'store'])->name('store');
            Route::get('/edit/{student}', [StudentsController::class, 'edit'])->name('edit');
            Route::patch('/update/{student}', [StudentsController::class, 'update'])->name('update');
            Route::delete('/delete/{student}', [StudentsController::class, 'delete'])->name('delete');
        });

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/daftar', [UsersController::class, 'daftar'])->name('daftar');
            Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('edit');
            Route::patch('/update/{user}', [UsersController::class, 'update'])->name('update');
            Route::delete('/delete/{user}', [UsersController::class, 'destroy'])->name('delete');
        });

        // keterlambatan admin
        Route::prefix('/lates')->name('admin.lates.')->group(function () {
            Route::get('/', [LatesController::class, 'index'])->name('data');
            Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
            Route::get('/create', [LatesController::class, 'create'])->name('create');
            Route::post('/store', [LatesController::class, 'store'])->name('store');
            Route::get('/search', [LatesController::class, 'search'])->name('search');
            Route::get('/detail/{nis}', [LatesController::class, 'detail'])->name('detail');
            Route::get('/edit/{id}', [LatesController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [LatesController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [LatesController::class, 'destroy'])->name('delete');
            Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
            Route::get('/pdf/{nis}', [LatesController::class, 'createPDF'])->name('eksport.pdf');
        });
    });

    Route::middleware('IsPs')->group(function () {
        Route::prefix('/lates')->name('ps.lates.')->group(function () {
            Route::get('/ltps', [LatesController::class, 'index'])->name('data');
            Route::get('/detaill/{nis}', [LatesController::class, 'detail'])->name('detailPs');
            Route::get('/rekapData', [LatesController::class, 'rekap'])->name('rekapData');
            Route::get('/eks/{nis}', [LatesController::class, 'createPDF'])->name('export.pdf');


            // Closing the 'group' method for ps.lates
        });

        Route::prefix('/student')->name('ps.student.')->group(function () {
            Route::get('/', [StudentsController::class, 'siswa'])->name('indexPs');
        });
        // Closing the 'group' method for ps.student
    });
});
