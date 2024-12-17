<div>
    <div class="text-sm font-medium text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <div>

            <button wire:click="setTab('hoje')"
                class="px-4 py-2 font-medium text-sm border-b-2 transition-all
                {{ $currentTab === 'hoje' ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Hoje
            </button>

            <button wire:click="setTab('abertas')"
                class="px-4 py-2 font-medium text-sm border-b-2 transition-all
            {{ $currentTab === 'abertas' ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Abertas
            </button>

            <button wire:click="setTab('pendentes')"
                class="px-4 py-2 font-medium text-sm border-b-2 transition-all
        {{ $currentTab === 'pendentes' ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Pendentes
            </button>

            <button wire:click="setTab('atrasadas')"
                class="px-4 py-2 font-medium text-sm border-b-2 transition-all
            {{ $currentTab === 'atrasadas' ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Atrasadas
            </button>

            <button wire:click="setTab('encerradas')"
                class="px-4 py-2 font-medium text-sm border-b-2 transition-all
        {{ $currentTab === 'encerradas' ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Encerradas
            </button>


            <button wire:click="setTab('geral')"
                class="px-4 py-2 font-medium text-sm border-b-2 transition-all
                {{ $currentTab === 'geral' ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                Geral
            </button>
        </div>

    </div>

    <div class="mt-6">
        @if ($currentTab === 'hoje')
            <div>
                @livewire('service-order-today')
            </div>
        @elseif ($currentTab === 'abertas')
            <div>
                @livewire('service-order-open')
            </div>
        @elseif ($currentTab === 'atrasadas')
            <div>
                @livewire('service-order-late')
            </div>
        @elseif ($currentTab === 'pendentes')
            <div>
                @livewire('service-order-pendding')
            </div>
        @elseif ($currentTab === 'encerradas')
            <div>
                @livewire('service-order-closed')
            </div>
        @elseif ($currentTab === 'geral')
            <div>
                @livewire('service-order-general')
            </div>
        @endif
    </div>
</div>
