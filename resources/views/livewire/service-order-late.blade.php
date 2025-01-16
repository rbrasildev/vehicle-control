<div>
    <div wire:loading.class="opacity-50" wire:loading.class.remove="opacity-100"
        class="relative overflow-x-auto sm:rounded-lg flex flex-col w-full h-full text-gray-700 border dark:border-gray-800 rounded-lg bg-clip-border">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-800">
                <tr>
                    <th class="py-4 px-4 border-b dark:border-gray-700 dark:text-slate-400">Conexão</th>
                    <th class="py-4 px-4 border-b dark:border-gray-700 dark:text-slate-400">Técnico.</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Cliente</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Endereço</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Bairro</th>
                    <th class="p-4 border-b dark:border-gray-700 dark:text-slate-400">Motivo</th>
                    <th class="p-4 border-b dark:border-gray-700 dark:text-slate-400">Agendamento</th>
                    <th class="p-4 border-b dark:border-gray-700 dark:text-slate-400">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($serviceOrders as $serviceOrder)
                    <tr wire:key="cliente-{{ $serviceOrder->cliente_id }}">
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <livewire:is-online :login="$serviceOrder->login"
                                wire:key="is-online-{{ $serviceOrder->cliente_id }}" />
                        </td>
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $serviceOrder->username }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $serviceOrder->cliente_id }}/edit/">
                                <p class="text-sm dark:slate-800 dark:text-slate-300 font-bold">
                                    {{ $serviceOrder->nome }}</p>
                                <p class="text-sm text-slate-500">{{ $serviceOrder->conteudo }}</p>
                                @if ($serviceOrder->servicoprestado)
                                    <p class="text-sm text-slate-500 dark:text-slate-200"><span
                                            class="text-blue font-bold">Serviço prestado:</span>
                                        {{ $serviceOrder->servicoprestado }}</p>
                                @endif
                            </a>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $serviceOrder->logradouro }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $serviceOrder->bairro }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $serviceOrder->descricao }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">
                                {{ \Carbon\Carbon::parse($serviceOrder->data_agendamento)->format('d/m/Y') }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
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
