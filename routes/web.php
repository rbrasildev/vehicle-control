<?php


use App\Livewire\Collect\Collect;
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
use App\Livewire\TabCollect;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::get('/veiculos', Vehicles::class);
Route::get('/veiculos/details/{vehicle_id}', VehicleDetails::class);
Route::get('/veiculos/create', CreateVehicle::class);

Route::get('/oil', CreateService::class);
Route::get('/oil/create', CreateService::class);

Route::get('/servico', ServiceOrder::class);
Route::get('/servico/atrasadas', ServiceOrderLate::class);
Route::get('/servico/hoje', ServiceOrderOpen::class);

Route::get('/recolher', TabCollect::class);

Route::get('/fttx/onu', FttxOnu::class);


require __DIR__ . '/auth.php';
