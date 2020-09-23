<?php

use App\Http\Livewire\Barang;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\DetailOrder;
use App\Http\Livewire\Order;
use App\Http\Livewire\Pelanggan;
use App\Http\Livewire\Sales;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/pelanggan', Pelanggan::class)->name('pelanggan');
    Route::get('/sales', Sales::class)->name('sales');
    Route::get('/barang', Barang::class)->name('barang');

    Route::get('/order', Order::class)->name('order');
    Route::get('/tambah-order', CreateOrder::class)->name('create.order');
    Route::get('/order/{id}', DetailOrder::class)->name('detail.order');
});
