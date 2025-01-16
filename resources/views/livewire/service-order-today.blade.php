<div wire:poll.10s>
    <div class="flex gap-6 mb-2 justify-between flex-wrap">
        <div class="flex gap-2 items-center">
            <div class="max-w-sm mx-start">
                <label for="countries" class="block  text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select wire:model.live="status" class="select select-bordered w-full max-w-xs">
                    <option value="" selected>Todas</option>
                    <option value="0">Abertas</option>
                    <option value="2">Execução</option>
                    <option value="3">Pendentes</option>
                    <option value="1">Encerradas</option>
                </select>
            </div>
        </div>

        <ul class="flex gap-2 justify-end items-center">
            @foreach ($statusCounts as $item)
                @if ($item->status == 0)
                    <li class="flex flex-col justify-center items-center px-4">
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Abertas</span>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif


                @if ($item->status == 2)
                    <li class="flex flex-col justify-center items-center px-4">
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Execução</span>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif

                @if ($item->status == 3)
                    <li class="flex flex-col justify-center items-center  px-4">
                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Pendentes</span>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif

                @if ($item->status == 1)
                    <li class="flex flex-col justify-center items-center px-4">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Encerradas</span>
                        <p class="font-bold dark:text-slate-200">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</p>
                    </li>
                @endif
            @endforeach
            <li class="flex flex-col justify-center items-center px-4">
                <p class="dark:text-slate-400">Total</p>
                <p class="font-bold dark:text-slate-200">{{ STR_PAD($clientes->count(), 2, '0', STR_PAD_LEFT) }}</p>
            </li>
        </ul>

        <ul class="list-group flex gap-2 items-center">
            @foreach ($technicianOsCount as $item)
                <li class="flex items-center justify-center flex-col gap-1  px-4">
                    <p class="text-slate-800 dark:text-slate-200">{{ $item->username }}</p>
                    <strong
                        class="text-slate-800 dark:text-slate-200 font-bold">{{ STR_PAD($item->total, 2, '0', STR_PAD_LEFT) }}</strong>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th>Wifi</th>
                    <th>Técnico</th>
                    <th>Cliente</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Motivo</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($clientes as $key => $cliente)
                    <tr wire:key="cliente-{{ $cliente->cliente_id }}">
                        <td @class(['bg-base-200' => $key % 2 == 0])> <livewire:is-online :login="$cliente->login"
                                wire:key="is-online-{{ $cliente->cliente_id }}" />
                        </td>
                        <td @class(['bg-base-200' => $key % 2 == 0])>{{ $cliente->username }}</td>
                        <td @class(['bg-base-200' => $key % 2 == 0])>
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $cliente->cliente_id }}/edit/">
                                <p class="text-sm dark:slate-800 dark:text-slate-300 font-semibold">
                                    {{ $cliente->nome }}
                                </p>
                                @if ($cliente->servicoprestado)
                                    <p class="text-sm text-slate-500 dark:text-slate-200">
                                        <span class="text-blue-300 font-normal">Serviço prestado:</span>
                                        {{ $cliente->servicoprestado }}
                                    </p>
                                @else
                                    <p> {{ $cliente->conteudo }}</p>
                                @endif
                            </a>
                        </td>
                        <td @class(['bg-base-200' => $key % 2 == 0])>{{ $cliente->logradouro }}</td>
                        <td @class(['bg-base-200' => $key % 2 == 0])>{{ $cliente->bairro }} </td>
                        <td @class(['bg-base-200' => $key % 2 == 0])>{{ $cliente->descricao }}
                        </td>
                        <td @class(['bg-base-200' => $key % 2 == 0])>
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
