<div class="dark:bg-base-200 mt-2 p-4 rounded-xl">
    <x-mary-header title="Gráfico de coleta" subtitle="Total de coleta por mês" size="text-xl">
        <x-slot:actions>
            <select class="select select-secondary select-sm select-bordered w-full max-w-24"
                wire:model.live="selectedYear">
                <?php
                for ($i = 2022; $i <= date('Y'); $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>
        </x-slot:actions>
    </x-mary-header>
    <x-mary-chart wire:model="myChart" />
</div>
