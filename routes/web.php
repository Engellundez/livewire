<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowPosts;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
	Route::get('/', ShowPosts::class)->name('home');

	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('/alpine', function () {
		return view('alpine.alpine');
	})->name('alpine');

	Route::get('/alpine-livewire', function () {
		return view('alpine.livewire');
	})->name('alpine.livewire');
});

// EJEMPLOS
