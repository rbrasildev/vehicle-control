<div wire:poll.5s>
    <x-mary-header title="Serviços" />
    <livewire:city-select />
    <div class="overflow-x-auto mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Wifi</th>
                    <th>Responsável</th>
                    <th>Técnico</th>
                    <th>Cliente</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Motivo</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($osOpenToday as $os)
                    <tr key="{{ $os->cliente_id }}" @class(['text-red-500' => $os->prioridade == 3 && $os->status != 1])>
                        <td>
                            <livewire:isOnline key="isOnline-{{ $os->cliente_id }}" :login="$os->login" />
                        </td>
                        <td>{{ $os->equipe }}</td>
                        <td>{{ $os->responsavel_username }}</td>
                        <td> <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $os->cliente_id }}/edit/">
                                <p class="text-sm dark:slate-800 dark:text-slate-300 font-semibold">
                                    {{ $os->nome }}
                                </p>
                                @if ($os->servicoprestado)
                                    <p class="text-sm text-slate-500 dark:text-slate-200">
                                        <span class="text-blue-300 font-normal">Serviço prestado:</span>
                                        {{ $os->servicoprestado }}
                                    </p>
                                @else
                                    <p> {{ $os->conteudo }}</p>
                                @endif
                            </a></td>
                        <td>{{ $os->logradouro }}</td>
                        <td>{{ $os->bairro }}</td>
                        <td>{{ $os->descricao }}</td>
                        @if ($os->status != 2)
                            <td><livewire:os-status key="os-status-{{ $os->cliente_id }}" :status="$os->status" /></td>
                        @else
                            <td><livewire:time-elapsed key="time-elapsed-{{ $os->cliente_id }}"
                                    wire:key="status-{{ $os->cliente_id }}" :dataCheckin="$os->data_checkin" /></td>
                        @endif
                    @empty
                        <td>
                            <p>Nenhum registro encontrado</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
