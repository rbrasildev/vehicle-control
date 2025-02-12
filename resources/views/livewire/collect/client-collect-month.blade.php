<div>
    <div class=" flex flex-col w-full h-full rounded-xl mt-2 p-4 shadow">
        <div class="flex items-center mb-2">
            <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                <i class='bx bx-undo dark:text-slate-400 text-3xl'></i>
            </div>
            <div>
                <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                    {{ $totalCanceled }}
                </h5>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Recolhidos:
                    {{ $totalCollected }}
                </p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-zebra table-compact hover:table-zebra-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo ONU</th>
                        <th>MAC</th>
                        <th>Cancelado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($collectThisMonth as $item)
                        <tr wire:key={{ $item->cliente_id }} class="text-red-500">
                            <td>
                                <a target="blank"
                                    href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $item->cliente_id }}/edit/">
                                    {{ $item->cliente_nome }}
                                </a>
                            </td>
                            <td>{{ $item->onutype }}</td>
                            <td>{{ $item->phy_addr }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->data_alteracao)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14">Nenhuma coleta encontrada para este mês.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 px-4">
            {{ $collectThisMonth->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
