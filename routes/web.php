<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [InventoryController::class, 'index'])->name('index');

Route::post('/', [InventoryController::class, 'store'])->name('store');

Route::get('/{id}/edit', [InventoryController::class, 'edit'])->name('edit');
Route::put('/{id}', [InventoryController::class, 'update'])->name('update');
 
Route::delete('/{id}', [InventoryController::class, 'destroy'])->name('destroy');
