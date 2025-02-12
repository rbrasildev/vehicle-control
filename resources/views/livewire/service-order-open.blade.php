@php
    $headers = [
        ['key' => 'username', 'label' => 'Tecnico'],
        ['key' => 'nome', 'label' => 'Nome'],
        ['key' => 'conteudo', 'label' => 'Conteudo'],
        ['key' => 'cidade', 'label' => 'Cidade'],
        ['key' => 'bairro', 'label' => 'Bairro'],
        ['key' => 'logradouro', 'label' => 'Rua'],
        ['key' => 'descricao', 'label' => 'Descrião'],
        ['key' => 'data_agendamento', 'label' => 'Agendamento', 'format' => ['date', 'd/m/Y']],
    ];
@endphp
<div>
    <div class="flex justify-between items-center gap-2 mb-2">
        <x-mary-datetime label="Selecione data" wire:model.live="selectedDate" icon="o-calendar"
            class="border border-base-200" />
        <div class="flex  gap-2">
            <p class="dark:text-gray-500 text-gray-600">Total</p>
            <p class="dark:text-gray-500 text-gray-600">({{ $statusCounts }})</p>
        </div>
    </div>

    <x-mary-table ... with-pagination :headers="$headers" :rows="$serviceOrders" striped
        link="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{cliente_id}/edit">
    </x-mary-table>
</div>
