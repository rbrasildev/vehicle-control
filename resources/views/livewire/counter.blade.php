<div class="flex jusitify-center flex-col items-center">
    <div class="flex justify-between bg-lime-900 p-3 gap-3">
        <button class="bg-lime-300 px-16 rounded-md hover:bg-lime-400" wire:click="decrement">-</button>
        <button class="bg-lime-300 px-16 rounded-md hover:bg-lime-400" wire:click="increment">+</button>
    </div>
    <h1 class="text-lime-300 font-bold text-3xl">{{ $count }}</h1>
</div>
