<?php

namespace App\Livewire\Wifi;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Wifi extends Component
{
    protected $listeners = ['connectionUpdated'];
    public $currentConnection;
    public $roteador = "wifi_ssid";
    public $search;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
    }

    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function updatedSearch($newSearch)
    {
        $this->search = $newSearch;
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }


    public function getWifiSsid()
    {
        $results = DB::connection($this->currentConnection)->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontratostatus.id', '=', 'admcore_clientecontrato.status_id')
            ->select(
                'admcore_cliente.id',
                'admcore_pessoa.nome',
                'admcore_servicointernet.login',
                'admcore_servicointernet.login_password',
                'admcore_servicointernet.mac',
                'admcore_servicointernet.wifi_password',
                'admcore_servicointernet.wifi_password_5',
                'admcore_servicointernet.wifi_ssid',
                'admcore_servicointernet.wifi_ssid_5'
            )
            ->where("admcore_servicointernet.{$this->roteador}", 'LIKE', "%{$this->search}%")
            ->take(10)->get();

        return $results;
    }
    public function render()
    {
        return view('livewire.wifi.wifi', ['wifi' => $this->getWifiSsid()]);
    }
}
