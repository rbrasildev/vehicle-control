<?php

use App\Livewire\CreateVehicle;
use App\Livewire\Dashboard;
use App\Livewire\OilChange;
use App\Livewire\User;
use App\Livewire\Vehicles;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/dashboard', Dashboard::class);
Route::get('/profile', User::class);

Route::get('/veiculos', Vehicles::class);
Route::get('/veiculos/create', CreateVehicle::class);

Route::get('/oil', OilChange::class);
