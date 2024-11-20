<?php

use App\Livewire\CreateVehicle;
use App\Livewire\Home;
use App\Livewire\User;
use App\Livewire\Vehicles;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);
Route::get('/profile', User::class);
Route::get('/veiculos', Vehicles::class);
Route::get('/veiculos/create', CreateVehicle::class);
