<?php
use App\Livewire\Web\Features\Home\Home;
use Illuminate\Support\Facades\Route;
Route::get('/', Home::class)->name('home');
Route::get('/test', function () {
    return view('welcome');
});
