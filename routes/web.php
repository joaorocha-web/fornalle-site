<?php

use App\Http\Controllers\PizzaController;
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

Route::get('/', function () {
    return view('site.login');
});

Route::prefix('pizza')->group(function(){
    Route::get('/', [PizzaController::class, 'index'])->name('pizza.index');
    Route::post('/', [PizzaController::class, 'store'])->name('pizza.store');
});

Route::get('/create', [PizzaController::class, 'create'])->name('pizza.create');
Route::get('/{id}/edit', [PizzaController::class, 'edit'])->where('id','[0-9]+')->name('pizza.edit');
Route::put('/{id}', [PizzaController::class, 'update'])->where('id','[0-9]+')->name('pizza.update');
Route::delete('/{id}', [PizzaController::class, 'destroy'])->where('id','[0-9]+')->name('pizza.destroy');


