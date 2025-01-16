@php
    $headers = [
        ['key' => 'placa', 'label' => 'Placa'],
        ['key' => 'marca', 'label' => 'Marca'],
        ['key' => 'modelo', 'label' => 'Modelo'],
        ['key' => 'km_ultima_troca', 'label' => 'Última troca'],
        ['key' => 'ano', 'label' => 'Ano'],
    ];
@endphp


<div>
    <x-mary-header title="Cadastro de Veículos" subtitle="Lista de carros cadastrados">
        <x-slot:middle class="!justify-end">
            <x-mary-input wire:model.live='search' icon="o-bolt" placeholder="Buscar..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button @click="$wire.vehicleModal = true" icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-mary-header>


    <x-mary-table :headers="$headers" :rows="$vehicles" striped link="/veiculos/details/{id}">
        @scope('actions', $vehicles)
            <x-mary-button icon="o-trash" wire:click="delete({{ $vehicles->id }})" spinner class="btn-sm" />
        @endscope
    </x-mary-table>

    <x-mary-modal wire:model="vehicleModal" title="Novo veículo" subtitle="Livewire example">
        <div>
            <x-mary-form wire:click='save'>

                <x-mary-input wire:model='form.placa' label="Placa" />
                <x-mary-input wire:model='form.marca' label="marca" />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <x-mary-input wire:model='form.modelo' label="modelo" />
                    <x-mary-input wire:model='form.ano' label="ano" />
                </div>
                <x-mary-input wire:model='form.tipo' label="tipo" />
                <x-mary-input wire:model='form.quilometragem' label="quilometragem" />
                <x-mary-button label="Confirm" class="btn-primary" />
                <x-mary-button label="Cancel" @click="$wire.vehicleModal = false" />
            </x-mary-form>
        </div>
    </x-mary-modal>
</div>
