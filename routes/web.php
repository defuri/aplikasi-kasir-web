<?php

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckKasir;
use App\Http\Middleware\CheckManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\LaporanPDFController;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(CheckAdmin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/admin/users', function () {
        return view('admin.users');
    });

    Route::get('/admin/log', function () {
        return view('admin.log');
    });
});

Route::middleware(CheckKasir::class)->group(function () {
    Route::get('/kasir', [KasirController::class, 'index']);

    Route::get('/kasir/transaksi', function () {
        return view('kasir.transaksi');
    });

    Route::get('/kasir/meja', function () {
        return view('kasir.meja');
    });

    Route::get('/kasir/riwayat', function () {
        return view('kasir.riwayat');
    });

    Route::get('/kasir/log', function () {
        return view('kasir.log');
    });

    Route::post('/kasir/cetak', [KasirController::class, 'cetak'])->name('kasir.cetak');
});

Route::middleware(CheckManager::class)->group(function () {
    Route::get('/manager', [ManagerController::class, 'index']);

    Route::get('/manager/menu', function () {
        return view('manager.menu');
    });

    Route::get('/manager/meja', function () {
        return view('manager.meja');
    });

    Route::get('manager/transaksi', function () {
        return view('manager.transaksi');
    });

    Route::get('manager/log', function () {
        return view('manager.log');
    });

    Route::get('/manager/laporan', function () {
        return view('manager.laporan');
    });
});

Route::get('/laporan/pdf', [LaporanPDFController::class, 'generatePDF'])->name('laporan.pdf');
