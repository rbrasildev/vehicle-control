<div class="grid sm:grid-cols-4 grid-cols-1 gap-2 sm:gap-16">
    <div class="flex justify-between items-center dark:border-base-300 dark:bg-base-200 p-6 rounded-xl shadow">
        <div>
            <h3 class="text-xl font-semibold mb-3">Total Recolher</h3>
            <h1 class="text-3xl font-bold">{{ $totalCollect }}</h1>
        </div>
        <div class="bg-secondary dark:bg-secondary rounded-xl p-3">
            <i class="bx bx-undo text-base-100 text-3xl"></i>
        </div>
    </div>
    @foreach ($total as $item)
        <div class="flex relative justify-between items-center dark:bg-base-200  p-6 rounded-xl shadow">
            <div>
                @if ($item->status === 0)
                    <h3 class="text-xl font-semibold mb-3">Abertas</h3>
                @elseif($item->status == 1)
                    <h3 class="text-xl font-semibold mb-3">Encerradas</h3>
                @elseif($item->status == 3)
                    <h3 class="text-xl font-semibold mb-3">Pendentes</h3>
                @endif
                <h1 class="text-3xl font-bold">{{ $item->total }}</h1>
            </div>
            <div class="bg-primary rounded-xl p-3 absolute top-[-5px] right-[-5px]">
                <i class="bx bxs-wallet text-slate-100 text-3xl"></i>
            </div>
        </div>
    @endforeach

</div>
