<div>
    <div class="flex gap-2 mb-2 justify-between items-center flex-wrap">
        <livewire:city-select />
        <div class="flex gap-2 flex-wrap">
            @foreach ($models as $model)
                <button wire:click="modelSort('{{ $model->onutype }}')"
                    class="flex gap-2 items-center bg-gray-50 hover:bg-gray-100 transition-all border border-slate-200 dark:hover:bg-slate-900 dark:border-slate-700 dark:bg-gray-800 px-2 rounded-lg text-center cursor-pointer">
                    <i class='bx bx-filter-alt text-md text-slate-500 dark:text-slate-500'></i>
                    <div class="flex gap-2 items-center  justify-center">
                        <p class="dark:text-slate-300 text-sm">{{ $model->onutype }}</p>
                        <span class="dark:text-slate-300 text-sm text-center font-semibold">({{ $model->total }})</span>
                    </div>
                </button>
            @endforeach
            <div
                class="bg-gray-50 border border-slate-200 dark:border-slate-700 dark:bg-gray-800 p-2 rounded-lg text-center flex justify-center items-center">
                <span class="dark:text-slate-300">Total</span>
                <span class="dark:text-slate-300 text-center font-semibold px-4">({{ $collectTotal }})</span>
            </div>
        </div>
    </div>
    <div wire:loading.class="opacity-50" wire:loading.class.remove="opacity-100"
        class="relative overflow-x-auto sm:rounded-lg flex flex-col w-full h-full text-gray-700 border dark:border-gray-800 rounded-lg bg-clip-border">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-800">
                <tr>
                    <th class="p-2 py-4 border-b dark:border-gray-700 dark:text-slate-400">Nome</th>
                    <th class="p-2 py-4 border-b dark:border-gray-700 dark:text-slate-400">Onu Tipo</th>
                    <th class="p-2 py-4 border-b dark:border-gray-700 dark:text-slate-400">Rua</th>
                    <th class="p-2 py-4 border-b dark:border-gray-700 dark:text-slate-400">Bairro</th>
                    <th class="p-2 py-4 border-b dark:border-gray-700 dark:text-slate-400">Cancelamento</th>
                    {{-- <th class="p-2 py-4 border-b dark:border-gray-700 dark:text-slate-400">OS Status</th> --}}
                </tr>
            </thead>

            <tbody>
                @forelse ($collectData as $collect)
                    <tr wire:key="cliente-{{ $collect->cliente_id }}">
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $collect->cliente_id }}/edit/">
                                <p class="text-sm text-slate-700 font-semibold dark:text-slate-300">{{ $collect->nome }}</p>
                            </a>
                        </td>
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500 dark:text-slate-300">{{ $collect->onutype }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500 dark:text-slate-300">{{ $collect->logradouro }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500 dark:text-slate-300">{{ $collect->bairro }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500 dark:text-slate-300">
                                {{ \Carbon\Carbon::parse($collect->data_alteracao)->format('d/m/Y') }}</p>
                        </td>
                        {{-- <td class="p-2 border-b dark:border-gray-800">
                            <livewire:collect-status />
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center">
                            <p class="text-lg dark:text-gray-200 text-gray-800">Nenhum registro</p>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="flex justify-between p-4">
            <div class="max-w-24 mx-start ">
                <select wire:model.live="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="px-4 flex-1">
                {{ $collectData->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>

</div>
