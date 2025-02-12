<div>
    <x-mary-header title="Ordens de serviço" subtitle="Lista de ordens de serviço">
        <x-slot:actions>
            <livewire:city-select />
        </x-slot:actions>
    </x-mary-header>
    <x-mary-tabs wire:model.live="selectedTab">
        <x-mary-tab name="today-tab">
            <x-slot:label>
                <span class="text-info">Hoje</span>
            </x-slot:label>
            <livewire:service-order-today lazy />
        </x-mary-tab>

        <x-mary-tab name="abertas-tab">
            <x-slot:label>
                <span class="text-primary">Abertas</span>
            </x-slot:label>
            <livewire:service-order-open lazy />
        </x-mary-tab>

        <x-mary-tab name="pendentes-tab">
            <x-slot:label>
                <span class="text-base-content">Pendentes</span>
            </x-slot:label>
            <livewire:service-order-pendding lazy />
        </x-mary-tab>

        <x-mary-tab name="atrasadas-tab">
            <x-slot:label>
                <p class="text-error">Atrasadas</p>
            </x-slot:label>
            <livewire:service-order-late lazy />
        </x-mary-tab>

        <x-mary-tab name="encerradas-tab">
            <x-slot:label>
                <span class="text-success">Encerradas</span>
            </x-slot:label>
            <livewire:service-order-closed lazy />
        </x-mary-tab>

        <x-mary-tab name="audit-tab">
            <x-slot:label>
                <span class="text-secondary">Audição</span>
            </x-slot:label>
            <livewire:service-order.audit lazy/>
        </x-mary-tab>

    </x-mary-tabs>
</div>
