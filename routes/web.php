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


