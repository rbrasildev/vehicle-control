<div class="flex gap-2">
    <div class="max-w-32 mx-start">
        <select id="city" wire:model.live="currentConnection"
            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 ps-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="sgptins">Parintins</option>
            <option value="sgp">Pacajá</option>
            <option value="sgpanp">Anapu</option>
        </select>
    </div>
    <div class="max-w-sm mx-start">
        <select id="pop" wire:model.live="currentPop"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
           
            @foreach ($pops as $pop)
                <option value={{ $pop->id }}>{{ $pop->cidade }}</option>
            @endforeach
        </select>
    </div>
</div>
