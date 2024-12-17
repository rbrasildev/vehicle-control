<div>
    <div class="relative overflow-x-auto flex flex-col w-full h-full bg-white dark:bg-gray-800 text-gray-700 rounded-xl border dark:border-gray-600 border-gray-300 mt-2 p-4 bg-clip-border">
        <h1 class="uppercase mb-2 font-bold text-slate-500">Recolher esse mês {{$collectThisMonth->count()}}</h1>
    <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="rounded-md">
                <th class="p-2 border-b rounded-tl-xl text-sm dark:border-gray-800 bg-gray-200 dark:bg-slate-400 dark:text-slate-900">Nome</th>
                <th class="p-2 border-b text-sm dark:border-gray-800 bg-gray-200 dark:bg-slate-400 dark:text-slate-900">Tipo ONU</th>
                <th class="p-2 border-b text-sm dark:border-gray-800 bg-gray-200 dark:bg-slate-400 dark:text-slate-900">MAC</th>
                <th class="p-2 border-b rounded-tr-xl text-sm dark:border-gray-800 bg-gray-200 dark:bg-slate-400 dark:text-slate-900">Cancelado</th>
            </tr>
        </thead>
        <tbody class="px-4">
            @forelse($collectThisMonth as $item)
                <tr wire:key={{$item->cliente_id}}>
                    <td class="p-2 text-sm border-b text-red-400 dark:border-gray-700">{{ $item->cliente_nome }}</td>
                    <td class="p-2 text-sm border-b text-red-400 dark:border-gray-700">{{ $item->onutype }}</td>
                    <td class="p-2 text-sm border-b text-red-400 dark:border-gray-700">{{ $item->phy_addr }}</td>
                    <td class="p-2 text-sm border-b text-red-400 dark:border-gray-700">{{ \Carbon\Carbon::parse($item->data_alteracao)->format('d/m/Y') }}</td>
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
        {{ $collectThisMonth->links() }}
    </div>
    </div>
</div>
