<div>

    @php
        $cities = [
            ['id' => 'sgptins', 'name' => 'Parintins'],
            ['id' => 'sgp', 'name' => 'Pacajá'],
            ['id' => 'sgpanp', 'name' => 'Anapu'],
        ];

        $pops = [['id' => 'parintins', 'name' => 'barreirinha'], ['id' => 'BARREIRINHA', 'name' => 'Barreirinha']];
    @endphp
    <div class="flex gap-2">
        <x-mary-choices-offline class="w-42" wire:model.live="currentConnection"
             :options="$cities" placeholder="Selecione ..." single />
    </div>
</div>
