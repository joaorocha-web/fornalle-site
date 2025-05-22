<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Pizza;

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

Route::get('/', function(){
    $pizzas = Pizza::all();
    return view('site.index', ['pizzas' => $pizzas]);
})->name('main');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'validation'])->name('verifyLogin');

Route::get('/users', [UserController::class , 'register'])->name('user.register');
Route::post('/users', [UserController::class , 'store'])->name('user.store');
Route::get('/adm', [UserController::class , 'registerAdm'])->name('adm.register');
Route::post('/adm', [UserController::class , 'storeAdm'])->name('adm.store');

Route::prefix('pizza')->group(function(){
    Route::get('/', [PizzaController::class, 'index'])->name('pizza.index');
    Route::post('/', [PizzaController::class, 'store'])->name('pizza.store');
});

Route::get('/create', [PizzaController::class, 'create'])->name('pizza.create');
Route::get('/{id}/edit', [PizzaController::class, 'edit'])->where('id','[0-9]+')->name('pizza.edit');

Route::put('/{id}', [PizzaController::class, 'update'])->where('id','[0-9]+')->name('pizza.update');

Route::delete('/{id}', [PizzaController::class, 'destroy'])->where('id','[0-9]+')->name('pizza.destroy');





