<!-- resources/views/home.blade.php -->
<div>
    <div class=" dark:text-gray-400 shadow rounded-xl mb-2">
        <livewire:city-select />
    </div>
    <div class="mt-2">
        <livewire:client-collect-count />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2">
        <div>
        </div>
        <livewire:client-collect-month />
    </div>
