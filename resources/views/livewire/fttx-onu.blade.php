<div>
    <div class="flex gap-2 items-center">
        <livewire:city-select />
        <div class="w-full max-w-sm min-w-[200px] relative">
            <div class="relative">
                <input type="text" wire:model.live="onu" placeholder="Buscar ONU..."
                    class=" bg-white dark:bg-gray-800 w-full pr-11 h-10 pl-3 py-2.5 px-6 bg-transparent placeholder:text-slate-400 dark:text-slate-200 text-slate-700 text-sm border border-slate-200 rounded-lg transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md" />
                <button
                    class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex justify-center items-center bg-wdark:hite dark:bg-gr bg-gray-200adark:y-800 rounded "
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="w-8 h-8 text-slate-600 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>


    <div wire:loading.class="opacity-50" wire:loading.class.remove="opacity-100"
        class="relative overflow-x-auto sm:rounded-lg flex flex-col w-full h-full text-gray-700 border dark:border-gray-800 rounded-lg bg-clip-border mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-800">
                <tr>
                    <th class="py-4 px-4 border-b dark:border-gray-700 dark:text-slate-400">Nome</th>
                    <th class="py-4 px-4 border-b dark:border-gray-700 dark:text-slate-400">ONU Type.</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">MAC Address</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr>
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $result->cliente_id }}/edit/">
                                <p class="font-semibold text-gray-400">{{ $result->nome }}</p>
                            </a>
                        </td>
                        <td class="px-4 p-2 border-b dark:border-gray-800">{{ $result->onutype }}</td>
                        <td class="px-4 p-2 border-b dark:border-gray-800">{{ $result->phy_addr }}</td>
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            @if ($result->status == 3)
                                <p class="text-red-500">Cancelado</p>
                            @elseif ($result->status == 1)
                                <p class="text-green-500">Ativo</p>
                            @elseif($result->status == 4)
                                <p class="text-orange-500">Suspenso</p>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 p-2 border-b dark:border-gray-800" colspan="6">No results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
            {{ $results->links() }}
        </div>
    </div>
</div>
