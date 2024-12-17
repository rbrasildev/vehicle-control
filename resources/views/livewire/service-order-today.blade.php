<div wire:poll.5s="loadOpen">
    <div class="flex gap-6 mb-2 justify-between">
        <div class="flex gap-2 items-center">
            <div class="max-w-sm mx-start">
                <select wire:model.live="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected>Todas</option>
                    <option value="0">Abertas</option>
                    <option value="2">Execução</option>
                    <option value="3">Pendentes</option>
                    <option value="1">Encerradas</option>
                </select>
            </div>
            <livewire:city-select />
            <div class="max-w-sm mx-start">
                <select wire:model.live="pop_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($pops as $pop)
                        <option value={{ $pop->id }}>{{ $pop->cidade }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <ul class="flex gap-2 justify-end items-center">
            @foreach ($statusCounts as $item)
                @if ($item->status == 0)
                    <li class="flex flex-col justify-center items-center border-r px-4">
                        <p class="dark:text-slate-400">Abertas</p>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif


                @if ($item->status == 2)
                    <li class="flex flex-col justify-center items-center border-r px-4">
                        <p class="dark:text-slate-400">Execução</p>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif

                @if ($item->status == 3)
                    <li class="flex flex-col justify-center items-center border-r px-4">
                        <p class="dark:text-slate-400">Pendentes</p>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif

                @if ($item->status == 1)
                    <li class="flex flex-col justify-center items-center border-r  darK:border-slate-400 px-4">
                        <p class="dark:text-slate-400">Encerradas</p>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif
            @endforeach
            <li class="flex flex-col justify-center items-center border-r  darK:border-slate-400 px-4">
                <p class="dark:text-slate-400">Total</p>
                <p class="font-bold dark:text-slate-200">{{ STR_PAD($clientes->count(), 2, '0', STR_PAD_LEFT) }}</p>
            </li>
        </ul>

        <ul class="list-group flex gap-2 items-center">
            @foreach ($technicianOsCount as $item)
                <li class="flex items-center justify-center flex-col gap-1 border-r px-4">
                    <p class="text-slate-800 dark:text-slate-200">{{ $item->username }}</p>
                    <strong
                        class="text-slate-800 dark:text-slate-200 font-bold">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</strong>
                </li>
            @endforeach
        </ul>
    </div>
    <div
        class="relative overflow-x-auto sm:rounded-lg flex flex-col w-full h-full text-gray-700 border dark:border-gray-800 rounded-lg bg-clip-border">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-800">
                <tr>
                    <th class="py-4 px-4 border-b dark:border-gray-700 dark:text-slate-400">Conexão</th>
                    <th class="py-4 px-4 border-b dark:border-gray-700 dark:text-slate-400">Técnico.</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Cliente</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Endereço</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Bairro</th>
                    <th class="py-4 border-b dark:border-gray-700 dark:text-slate-400">Agendamento</th>
                    <th class="p-4 border-b dark:border-gray-700 dark:text-slate-400">Motivo</th>
                    <th class="p-4 border-b dark:border-gray-700 dark:text-slate-400">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($clientes as $cliente)
                    <tr wire:key="cliente-{{ $cliente->cliente_id }}">
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <livewire:is-online :login="$cliente->login" wire:key="is-online-{{ $cliente->cliente_id }}" />
                        </td>
                        <td class="px-4 p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $cliente->username }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <a target="blank"
                                href="{{ env('BASE_URL') }}/admin/cliente/{{ $cliente->cliente_id }}/edit/">
                                <p class="text-sm dark:slate-800 dark:text-slate-300 font-bold">{{ $cliente->nome }}
                                </p>
                                <p class="text-sm text-slate-500">{{ $cliente->conteudo }}</p>
                                @if ($cliente->servicoprestado)
                                    <p class="text-sm text-slate-500 dark:text-slate-200"><span
                                            class="text-blue font-bold">Serviço prestado:</span>
                                        {{ $cliente->servicoprestado }}</p>
                                @endif
                            </a>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $cliente->logradouro }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $cliente->bairro }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">{{ $cliente->descricao }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            <p class="text-sm text-slate-500">
                                {{ \Carbon\Carbon::parse($cliente->data_agendamento)->format('d/m/Y') }}</p>
                        </td>
                        <td class="p-2 border-b dark:border-gray-800">
                            @if ($cliente->status != 2)
                                <livewire:os-status :status="$cliente->status" wire:key="os-status{{ $cliente->cliente_id }}" />
                            @else
                                <span class="text-center text-white"><livewire:time-elapsed
                                        wire:key="status-{{ $cliente->cliente_id }}" :dataCheckin="$cliente->data_checkin" /></span>
                            @endif
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
    </div>
</div>
