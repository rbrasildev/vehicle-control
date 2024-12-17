<div class="grid sm:grid-cols-4 grid-cols-1 gap-2">
    @foreach ($total as $item)
        <div
            class="flex justify-between items-center bg-gray-50  dark:bg-gray-800 dark:border-gray-600 border-gray-300 text-gray-900 dark:text-gray-400  p-6 rounded-xl shadow-md border">
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
            <div class="bg-slate-900 rounded-xl p-3">
                <i class="bx bxs-wallet text-slate-100 text-3xl"></i>
            </div>
        </div>
    @endforeach
    <div
        class="flex justify-between items-center  bg-gray-50  dark:bg-gray-800 dark:border-gray-600 border-gray-300 dark:text-gray-400  p-6 rounded-xl shadow-md border">
        <div>
            <h3 class="text-xl font-semibold text-gray-700 dark:text-slate-300 mb-3">Abertas</h3>
            <h1 class="dark:text-zinc-500 text-3xl font-bold">198</h1>
        </div>
        <div class="bg-slate-950 rounded-xl p-3">
            <i class="bx bxs-wallet text-slate-100 text-3xl"></i>
        </div>
    </div>
</div>
