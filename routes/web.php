<?php

use App\Livewire\Collect;
use App\Livewire\CreateService;
use App\Livewire\CreateVehicle;
use App\Livewire\Dashboard;
use App\Livewire\FttxOnu;
use App\Livewire\User;
use App\Livewire\VehicleDetails;
use App\Livewire\Vehicles;
use App\Livewire\ServiceOrder;
use App\Livewire\ServiceOrderLate;
use App\Livewire\ServiceOrderOpen;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/dashboard', Dashboard::class);
Route::get('/profile', User::class);

Route::get('/veiculos', Vehicles::class);
Route::get('/veiculos/details/{vehicle_id}', VehicleDetails::class);
Route::get('/veiculos/create', CreateVehicle::class);

Route::get('/oil', CreateService::class);
Route::get('/oil/create', CreateService::class);

Route::get('/servico', ServiceOrder::class);
Route::get('/servico/atrasadas', ServiceOrderLate::class);
Route::get('/servico/hoje', ServiceOrderOpen::class);

Route::get('/recolher', Collect::class);

Route::get('/fttx/onu', FttxOnu::class);
