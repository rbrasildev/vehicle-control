<?php


use App\Livewire\CreateService;
use App\Livewire\CreateVehicle;
use App\Livewire\Dashboard;
use App\Livewire\FttxOnu;
use App\Livewire\VehicleDetails;
use App\Livewire\Vehicles;
use App\Livewire\TabServiceOrder;
use App\Livewire\ServiceOrder\Index;
use App\Livewire\ServiceOrderLate;
use App\Livewire\ServiceOrderOpen;
use App\Livewire\TabCollect;

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::view('/', 'welcome');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('/', 'index');                          // Home 
Volt::route('/users', 'users.index');               // User (list) 
Volt::route('/users/create', 'users.create');       // User (create) 
Volt::route('/users/{user}/edit', 'users.edit');    // User (edit) 

Volt::route('/login', 'login')->name('login');

Volt::route('/register', 'register');

// Define the logout
Route::get('/logout', function () {
    auth()->Logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
});

// Protected routes here
Route::middleware('auth')->group(function () {
    Volt::route('/', Dashboard::class);
    Volt::route('/users', 'users.index');
    Volt::route('/users/create', 'users.create');
    Volt::route('/users/{user}/edit', 'users.edit');
});

Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::get('/veiculos', Vehicles::class);
Route::get('/veiculos/details/{vehicle_id}', VehicleDetails::class);
Route::get('/veiculos/create', CreateVehicle::class);

Route::get('/oil', CreateService::class);
Route::get('/oil/create', CreateService::class);

Route::get('/servico', TabServiceOrder::class);
Route::get('/servico/atrasadas', ServiceOrderLate::class);
// Route::get('/servico/hoje', ServiceOrderOpen::class');
Route::get('/servico/live', Index::class);

Route::get('/recolher', TabCollect::class);

Route::get('/fttx/onu', FttxOnu::class);
