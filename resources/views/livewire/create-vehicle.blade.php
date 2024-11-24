<div>
    <h2 class="font-bold text-2xl  my-5">New Vehicle</h2>

    {{-- <form class="flex flex-col space-y-2" wire:submit="save">
        <label class="flex items-center gap-2" for="">
            <span>Placa</span>
            <input wire:model="placa" class="flex-1 rounded-md border border-1 p-2" type="text">
        </label>
        <label class="flex items-center gap-2" for="">
            <span>Marca</span>
            <input wire:model="marca" class="flex-1 rounded-md border border-1 p-2" type="text">
        </label>
        <label class="flex items-center gap-2" for="">
            <span>Modelo</span>
            <input wire:model="modelo" class="flex-1 rounded-md border border-1 p-2" type="text">
        </label>
        <label class="flex items-center gap-2" for="">
            <span>Ano</span>
            <input wire:model="ano" class="flex-1 rounded-md border border-1 p-2" type="text">
        </label>
        <label class="flex items-center gap-2" for="">
            <span>Chassi</span>
            <input wire:model="chassi" class="flex-1 rounded-md border border-1 p-2" type="text">
        </label>
        <button class="p-2 bg-green-600 rounded-md hover:bg-green-500 transtion-all duration-75"
            type="submit">Save</button>
    </form> --}}
    <div class="grid col-1 sm:grid-cols-3 gap-6">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" wire:model="modelo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Modelo" required />
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" wire:model="modelo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Modelo" required />
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" wire:model="modelo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Modelo" required />
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
            <input type="text" wire:model="modelo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Modelo" required />
        </div>
    </div>

</div>
