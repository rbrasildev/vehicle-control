<div>
    <h2 class="font-bold text-2xl  my-5">New Vehicle</h2>
    <form class="flex flex-col space-y-2" wire:submit="save">
        <div class="grid col-1 gap-4">
            <div class="flex gap-2 items-center">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Placa</label>
                <input type="text" wire:model="placa"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="placa" required />
            </div>
            <div class="flex gap-2 items-center">
                <label for="first_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">marca</label>
                <input type="text" wire:model="marca"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="marca" required />
            </div>
            <div class="flex gap-2 items-center">
                <label for="first_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo</label>
                <input type="text" wire:model="modelo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Modelo" required />
            </div>
            <div class="flex gap-2 items-center">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ano</label>
                <input type="text" wire:model="ano"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="ano" required />
            </div>
            <div class="flex gap-2 items-center">
                <label for="tipo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
                <select type="text" wire:model="tipo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option selected>Selecione tipo de veículo</option>
                    <option value="carro">Carro</option>
                    <option value="moto">Moto</option>

                </select>

            </div>
            <div class="flex gap-2 items-center">
                <label for="first_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">quilometragem</label>
                <input type="text" wire:model="quilometragem"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="quilometragem" required />
            </div>
        </div>
        <button class="p-2 bg-green-600 rounded-md hover:bg-green-500 transtion-all duration-75"
            type="submit">Save</button>
    </form>

</div>
