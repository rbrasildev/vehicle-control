<div>

    <div class="w-full bg-gray-50 rounded-xl shadow-lg mt-2 border dark:border-slate-700 dark:bg-gray-800 p-4">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                    <i class='bx bx-notepad dark:text-slate-400 text-3xl'></i>
                </div>
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                        {{ $totalMonth[0]->total }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Motivos ordem de serviços por mês
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 items-center justify-between">
                <input
                    class="bg-gray-50 w-40 text-sm my-2  border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="month" id="month" wire:model.live="selectedMonth">
            </div>
        </div>

        <div class="grid grid-cols-3 mb-2">
            <dl class="flex items-center">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Descrição:</dt>
            </dl>
            <dl class="flex items-center justify-center">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Percentual:</dt>
            </dl>
            <dl class="flex items-center justify-end">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Total:</dt>
            </dl>
        </div>

        <div id="column-chart">
            <table class="w-full">
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-sm dark:text-slate-400  w-48">{{ $item->descricao }}</td>
                            <td class=" px-4 flex items-center">
                                <div
                                    class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700 flex items-center gap-2">
                                    <div class="bg-blue-600 h-2 rounded-full dark:bg-blue-500"
                                        style="width: {{ $item->percentual }}%"></div>
                                    <span class="text-sm dark:text-slate-400">
                                        {{ number_format($item->percentual, 2) }}%</span>
                                </div>

                            </td>
                            <td class="text-sm dark:text-slate-400 text-end px-4 w-16">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
