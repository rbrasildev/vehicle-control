<div>
    <x-mary-tabs wire:model.live="selectedTab">
        <x-mary-tab name="today-tab">
            <x-slot:label>
                <span class="text-neutral-content">Hoje</span>
                <x-mary-badge value="{{ $totalOs[0] }}" class="badge-primary indicator-item" />
            </x-slot:label>
            <livewire:service-order-today lazy />
        </x-mary-tab>

        <x-mary-tab name="abertas-tab">
            <x-slot:label>
                <span>Abertas</span>
                <x-mary-badge value="{{ $totalOs[0] }}" class="badge-info indicator-item" />
            </x-slot:label>

            <livewire:service-order-open lazy />
        </x-mary-tab>

        <x-mary-tab name="pendentes-tab">
            <x-slot:label>
                <span class="text-neutral-content">Pendentes</span>
                <x-mary-badge value="{{ $totalOs[3] }}" class="badge-secondary indicator-item" />
            </x-slot:label>
            <livewire:service-order-pendding lazy />
        </x-mary-tab>

        <x-mary-tab name="atrasadas-tab">
            <x-slot:label>
                <p class="text-lg text-error">Atrasadas {{ $totalOs[2] }}</p>
            </x-slot:label>
            <livewire:service-order-late lazy />
        </x-mary-tab>

        <x-mary-tab name="encerradas-tab">
            <x-slot:label>
                <span class="text-neutral-content">Encerradas</span>
                <x-mary-badge value="{{ $totalOs[1] }}" class="badge-success indicator-item" />
            </x-slot:label>
            <livewire:service-order-closed lazy />
        </x-mary-tab>

    </x-mary-tabs>
</div>
