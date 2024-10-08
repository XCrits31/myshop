<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\CalculateUsageComponent;
use App\Livewire\CartComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ViewComponent;
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
    return view('welcome');
})->name('view.first');
Route::get('/index/{id}', ViewComponent::class)->name('view.second')->middleware('auth');
Route::get('/cart', CartComponent::class)->name("cart")->middleware('auth');
Route::get('/calculate', CalculateUsageComponent::class)->name("calc")->middleware('auth');
Route::post('/calculated',  [CalculateUsageComponent::class, 'calc'])->name("calc.post")->middleware('auth');
Route::post('/cart/destroy', [CartComponent::class, 'clear'])->name('cart.destroy')->middleware('auth');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
