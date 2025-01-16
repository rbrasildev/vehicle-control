<div>
    <x-mary-header title="ONU" subtitle="Listagem de ONU" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input class="border border-base-content" wire:model.live="onu" icon="o-bolt"
                placeholder="Buscar..." />
        </x-slot:middle>
        <x-slot:actions>
            <livewire:city-select />

        </x-slot:actions>
    </x-mary-header>

    <div class="overflow-x-auto">
        <table class="table table-zebra ">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>ONU Type.</th>
                    <th>MAC Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr>
                        <td>
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $result->cliente_id }}/edit/">
                                <p class="font-semibold text-gray-400">{{ $result->nome }}</p>
                            </a>
                        </td>
                        <td>{{ $result->onutype }}</td>
                        <td>{{ $result->phy_addr }}</td>
                        <td>
                            @if ($result->status == 3)
                                <p class="text-red-500">Cancelado</p>
                            @elseif ($result->status == 1)
                                <p class="text-green-500">Ativo</p>
                            @elseif($result->status == 4)
                                <p class="text-orange-500">Suspenso</p>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-between p-4">
        <div class="max-w-24 mx-start ">
            <select wire:model.live="perPage"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="px-4 flex-1">
            {{ $results->links() }}
        </div>
    </div>
</div>
