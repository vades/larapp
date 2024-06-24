<?php
use App\Livewire\Web\Home;
use Illuminate\Support\Facades\Route;
Route::get('/', Home::class);
Route::get('/test', function () {
    return view('welcome');
});
