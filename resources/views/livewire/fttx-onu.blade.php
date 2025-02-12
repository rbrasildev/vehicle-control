<div>
    <x-mary-header title="ONU" subtitle="Listagem de ONU" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input class="border border-base-content" wire:model.live="onu" icon="o-bolt" placeholder="Buscar..." />
        </x-slot:middle>
        <x-slot:actions>
            <livewire:city-select />

        </x-slot:actions>
    </x-mary-header>

    <div class="overflow-x-auto">
        <table class="table table-zebra table-compact hover:table-zebra-hover">
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
                                {{ $result->nome }}
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
        <div class="px-4 flex-1">
            {{ $results->links() }}
        </div>
    </div>
</div>
