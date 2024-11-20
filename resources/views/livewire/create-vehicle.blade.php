<div>
    <h2 class="font-bold text-2xl  my-5">New Vehicle</h2>

    <form class="flex flex-col space-y-2" wire:submit="save">
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
    </form>
</div>
