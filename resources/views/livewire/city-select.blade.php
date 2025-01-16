<div>

    @php
        $cities = [
            ['id' => 'sgptins', 'name' => 'Parintins'],
            ['id' => 'sgp', 'name' => 'Pacajá'],
            ['id' => 'sgpanp', 'name' => 'Anapu'],
        ];
    @endphp

    <x-mary-choices-offline class="border border-base-content w-42" wire:model.live="currentConnection" :options="$cities"
        placeholder="Selecione ..." single :allow-remove="false" />


</div>
