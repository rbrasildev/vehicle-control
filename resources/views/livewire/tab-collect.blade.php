<div>
    <x-mary-header title="Coletas" subtitle="Lista de equipamentos para recolher">
        <x-slot:actions>
            <livewire:city-select lazy />
        </x-slot:actions>
    </x-mary-header>
    <x-mary-tabs wire:model.live="selectedTab">
        <x-mary-tab name="collect-tab" label="Todos" spinner="selectedTab">
            <livewire:collect.collect lazy />
        </x-mary-tab>
        <x-mary-tab name="tricks-tab" label="Baixa pendente">
            <livewire:collect.pendding lazy />
        </x-mary-tab>
        <x-mary-tab name="negativado-tab" label="Negativados / Perdidos">
            <livewire:collect.negative lazy />
        </x-mary-tab>
    </x-mary-tabs>
</div>
