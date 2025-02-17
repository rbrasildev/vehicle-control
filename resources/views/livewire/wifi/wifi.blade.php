@php

    $headers = [
        ['key' => 'nome', 'label' => 'Nome'],
        ['key' => 'mac', 'label' => 'MAC'],
        ['key' => 'wifi_ssid', 'label' => 'Wifi 2.4'],
        ['key' => 'wifi_password', 'label' => 'Password'],
        ['key' => 'wifi_ssid_5', 'label' => 'Wifi 5'],
        ['key' => 'wifi_password_5', 'label' => 'Password 5'],
        ['key' => 'login', 'label' => 'Login'],
    ];
@endphp
<div>
    <x-mary-header title="Wifi" subtitle="Buscar wifi ">
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live="search" icon="o-bolt" placeholder="Buscar..." />
        </x-slot:middle>
    </x-mary-header>

    <x-mary-table zebra=true :headers="$headers" :rows="$wifi"
        link="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{id}/edit" />

</div>
