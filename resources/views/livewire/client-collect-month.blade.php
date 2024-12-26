<div>
    <div
        class="relative overflow-x-auto flex flex-col w-full h-full bg-white dark:bg-gray-800 text-gray-700 rounded-xl border dark:border-gray-600 border-gray-300 mt-2 p-4 bg-clip-border">
        <div class="flex items-center mb-2">
            <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                <i class='bx bx-undo dark:text-slate-400 text-3xl'></i>

            </div>
            <div>
                <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                    {{ $totalCanceled }}
                </h5>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Recolhidos:
                    {{ $totalCanceled - $totalCollected }}
                </p>
            </div>
        </div>
        <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700  dark:text-gray-400">
                <tr class="rounded-md">
                    <th class="p-2 border-b rounded-tl-xl text-sm dark:border-gray-800 dark:text-slate-400">
                        Nome</th>
                    <th class="p-2 border-b text-sm dark:border-gray-800 dark:text-slate-400">
                        Tipo ONU</th>
                    <th class="p-2 border-b text-sm dark:border-gray-800 dark:text-slate-400">
                        MAC</th>
                    <th class="p-2 border-b rounded-tr-xl text-sm dark:border-gray-800 dark:text-slate-400">
                        Cancelado</th>
                </tr>
            </thead>
            <tbody class="px-4">
                @forelse($collectThisMonth as $item)
                    <tr wire:key={{ $item->cliente_id }}>
                        <td class="py-1 text-sm border-b text-red-400 dark:border-gray-700">
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $item->cliente_id }}/edit/">
                                {{ $item->cliente_nome }}
                            </a>
                        </td>
                        <td class="py-1 text-sm border-b text-red-400 dark:border-gray-700">{{ $item->onutype }}</td>
                        <td class="py-1 text-sm border-b text-red-400 dark:border-gray-700">{{ $item->phy_addr }}</td>
                        <td class="py-1 text-sm border-b text-red-400 dark:border-gray-700">
                            {{ \Carbon\Carbon::parse($item->data_alteracao)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14">Nenhuma coleta encontrada para este mês.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="mt-4 px-4">
            {{ $collectThisMonth->links(data: ['scrollTo' => false])}}
        </div>
    </div>
</div>
