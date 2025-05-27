<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Pizza;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    $categories = ['Tradicional', 'Doce', 'Especial'];
    
    return view('site.index', ['pizzas' => $pizzas, 'categories' => $categories]);
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
Route::delete('/pizza/{pizza}', [PizzaController::class, 'destroy'])->name('pizza.destroy');


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/dashboardPizzas', [DashboardController::class, 'bestSellers'])->name('pizza.dashboard');
 



Route::post('/cart/{id}', [CartController::class, 'add'])->where('id', '[0-9]+')->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->where('id', '[0-9]+')->name('cart.show');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->where('id', '[0-9]+')->name('cart.remove');

Route::get('/checkout', [CheckOutController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [CheckOutController::class, 'finishCheckout'])->name('checkout.finish');





