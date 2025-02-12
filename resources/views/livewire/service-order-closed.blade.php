<div>
    <div class="flex gap-2 mb-2">

        <x-mary-datetime class="max-w-48" label="Data" wire:model.live="selectedDate" icon="o-calendar" />

    </div>
    <div class="overflow-x-auto">
        <table class="table table-zebra table-compact hover:table-zebra-hover">
            <thead>
                <tr>
                    <th>Conexão</th>
                    <th>Técnico.</th>
                    <th>Cliente</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Motivo</th>
                    <th>Agendamento</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($serviceOrders as $serviceOrder)
                    <tr wire:key="cliente-{{ $serviceOrder->cliente_id }}">
                        <td>
                            <livewire:is-online :login="$serviceOrder->login" wire:key="is-online-{{ $serviceOrder->cliente_id }}" />
                        </td>
                        <td>
                            {{ $serviceOrder->username }}
                        </td>
                        <td>
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $serviceOrder->cliente_id }}/edit/">
                                <p>{{ $serviceOrder->nome }}</p>
                                <p>{{ $serviceOrder->conteudo }}</p>
                                @if ($serviceOrder->servicoprestado)
                                    <p class="text-sm text-slate-500 dark:text-slate-200"><span
                                            class="text-blue font-bold">Serviço prestado:</span>
                                        {{ $serviceOrder->servicoprestado }}</p>
                                @endif
                            </a>
                        </td>
                        <td> {{ $serviceOrder->logradouro }}</td>
                        <td>{{ $serviceOrder->bairro }}</td>
                        <td>{{ $serviceOrder->cidade }}</td>
                        <td>{{ $serviceOrder->descricao }}</td>
                        <td>

                            {{ \Carbon\Carbon::parse($serviceOrder->data_agendamento)->format('d/m/Y') }}
                        </td>
                        <td>
                            <livewire:os-status :status="$serviceOrder->status"
                                wire:key="os-status{{ $serviceOrder->cliente_id }}" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center">
                            <p class="text-lg dark:text-gray-200 text-gray-800">Nenhum registro</p>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="flex justify-between p-4">


            <div class="px-4 flex-1">
                {{ $serviceOrders->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>

</div>
