<div class="grid sm:grid-cols-4 grid-cols-1 gap-2 sm:gap-16">
    <div
        class="flex justify-between items-center dark:border-gray-700 border-gray-300 dark:text-gray-400  p-6 rounded-xl shadow-md border">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 dark:text-slate-300 mb-3">Total Recolher</h3>
            <h1 class="dark:text-zinc-500 text-3xl font-bold">{{ $totalCollect }}</h1>
        </div>
        <div class="dark:bg-red-500 bg-slate-200 rounded-xl p-3">
            <i class="bx bx-undo text-slate-500 text-3xl"></i>
        </div>
    </div>
    @foreach ($total as $item)
        <div
            class="flex relative justify-between items-center bg-gray-50  dark:bg-gray-800 dark:border-gray-600 border-gray-300 text-gray-900 dark:text-gray-400  p-6 rounded-xl shadow-md border">
            <div>
                @if ($item->status === 0)
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-slate-300 mb-3">Abertas</h3>
                @elseif($item->status == 1)
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-slate-300 mb-3">Encerradas</h3>
                @elseif($item->status == 3)
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-slate-300 mb-3">Pendentes</h3>
                @endif
                <h1 class="dark:text-zinc-500 text-3xl font-bold">{{ $item->total }}</h1>
            </div>
            <div class="bg-blue-950 rounded-xl p-3 absolute top-[-5px] right-[-5px]">
                <i class="bx bxs-wallet text-slate-100 text-3xl"></i>
            </div>
        </div>
    @endforeach

</div>
