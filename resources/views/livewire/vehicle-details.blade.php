@php
    $headers = [
        ['key' => 'data_troca', 'label' => 'Data troca'],
        ['key' => 'quilometragem', 'label' => 'KM'],
        ['key' => 'nome', 'label' => 'Tipo de óleo'],
        ['key' => 'viscosidade', 'label' => 'Viscosidade'],
        ['key' => 'observacao', 'label' => 'Observação'],
    ];

    $rows = $oilChange->map(function ($item) {
        return [
            'data_troca' => $item->data_troca,
            'quilometragem' => $item->quilometragem,
            'nome' => $item->typeOfOil->nome, // Acessa o relacionamento
            'viscosidade' => $item->typeOfOil->viscosidade, // Acessa o relacionamento
            'observacao' => $item->observacao,
        ];
    });
@endphp
<div>
    <x-mary-header title="{{ $vehicle->modelo }}" subtitle="{{ $vehicle->placa }}">
        <x-slot:actions>
            <x-mary-button icon="o-funnel" />
            <x-mary-button icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-mary-header>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">

        <div class="sm:col-span-1">
            <div class="p-4 grid grid-cols-4">
                <div>
                    <p class="text-slate-900 dark:text-slate-400">Marca</p>
                    <p class="text-slate-900 dark:text-slate-100 text-xl">{{ $vehicle->marca }}</p>
                </div>
                <div>
                    <p class="text-slate-900 dark:text-slate-400">Modelo</p>
                    <p class="text-slate-900 dark:text-slate-100">{{ $vehicle->modelo }}</p>
                </div>
                <div>
                    <p class="text-slate-900 dark:text-slate-400">Placa</p>
                    <p class="text-slate-900 dark:text-slate-100">{{ $vehicle->placa }}</p>
                </div>
                <div>
                    <p class="text-slate-900 dark:text-slate-400">KM</p>
                    <p class="text-slate-900 dark:text-slate-100">{{ $vehicle->quilometragem }}</p>
                </div>
            </div>

            <img src="https://production.autoforce.com/uploads/version/profile_image/9614/model_middle_webp_comprar-like-1-0_182823d236.png.webp"
                alt="">
            <ul class="dark:bg-slate-800 rounded-xl p-4 ">
                <li class="dark:text-slate-300">Km atual {{ $vehicle->quilometragem }}</li>
                <li class="dark:text-slate-300">Próxima troca {{ $vehicle->km_ultima_troca + 5000 }}</li>
            </ul>
        </div>


        <div class="px-4 mt-2 sm:col-span-2">
            <h1 class="font-bold dark:text-gray-500 my-5">Histórico de troca de óleo</h1>

            <x-mary-table striped :headers="$headers" :rows="$rows" />
        </div>

    </div>
</div>
