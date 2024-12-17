<div>
    <livewire:modal :vehicleId="$vehicle->id" />
    <div class="shadow bg-white border border-zinc-200 dark:border-slate-700 dark:bg-slate-800 rounded-xl p-4 grid grid-cols-4">
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
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
        <div class="sm:col-span-1">
            <img src="https://production.autoforce.com/uploads/version/profile_image/9614/model_middle_webp_comprar-like-1-0_182823d236.png.webp"
                alt="">
            <ul class="dark:bg-slate-800 rounded-xl p-4 ">
                <li class="dark:text-slate-300">Km atual {{ $vehicle->quilometragem }}</li>
                <li class="dark:text-slate-300">Próxima troca {{ $vehicle->km_ultima_troca + 5000 }}</li>
            </ul>
        </div>

        <div class="shadow dark:bg-slate-800 px-4 mt-2 rounded-xl sm:col-span-2">
            <h1 class="font-bold dark:text-gray-500 my-5">Histórico de troca de óleo</h1>
            <div class="overflow-x-scroll sm:overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-700">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    Data
                                </p>
                            </th>
                            <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-700">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    Km da troca
                                </p>
                            </th>
                            <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-700">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    km restante
                                </p>
                            </th>
                            <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-700">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    tipo de óleo
                                </p>
                            </th>
                            <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-700">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    Observações
                                </p>
                            </th>
                            <th class="p-4 border-b dark:border-gray-700 bg-gray-200 dark:bg-gray-700">
                                <p class="text-sm font-normal leading-none text-slate-500">
                                    Ações
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($oilChange as $oilChanges)
                            <tr wire:key="{{ $oilChanges->id }}"
                                class=" border-b border-slate-200 dark:border-gray-700">
                                <td class="p-4 py-2">
                                    <p class="block font-semibold text-sm text-slate-800 dark:text-slate-300">
                                        {{ \Carbon\Carbon::parse($oilChanges->data_troca)->format('d/m/Y') }}
                                    </p>
                                </td>
                                <td class="p-4 py-2">
                                    <p class="text-sm text-slate-500">
                                        {{ $oilChanges->quilometragem }}</p>
                                </td>
                                <td class="p-4 py-2">
                                    <p class="text-sm text-slate-500">
                                        {{ $oilChanges->quilometragem + 5000 - $oilChanges->vehicle->quilometragem }}
                                    </p>
                                </td>
                                <td class="p-4 py-2">
                                    <p class="text-sm text-slate-500">{{ $oilChanges->typeOfOil->nome }}</p>
                                    <p class="text-sm text-slate-500">{{ $oilChanges->typeOfOil->viscosidade }}</p>
                                </td>
                                <td class="p-4 py-2">
                                    <p class="text-sm text-slate-500">{{ $oilChanges->observacoes }}</p>
                                </td>
                                <td class="p-4 py-2">
                                    <button
                                        onclick="confirm('Are you sure want to delete {{ $oilChanges->modelo }}?') || event.stopImmediatePropagation()"
                                        wire:click="delete({{ $oilChanges->id }})"><i
                                            class="bx bx-trash cursor-pointer text-red-500"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-4 py-2 dark:text-gray-300 text-center text-sm text-gray-800">
                                    Nenhumn troca de óleo realizada
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
