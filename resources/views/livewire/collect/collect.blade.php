<div>

    <div class="flex gap-2 mb-2 justify-between items-center flex-wrap">
        <div class="flex gap-2 flex-wrap">
            @foreach ($models as $model)
                <x-mary-button spinner="sort" label="{{ $model->onutype }}" wire:click="modelSort('{{ $model->onutype }}')"
                    class="bedge-secondary btn btn-ghost dark:btn-neutral  indicator" badge="{{ $model->total }}"
                    badge-classes="badge-success" responsive />
            @endforeach
            <x-mary-button spinner="sort" label="Total" class="btn btn-ghost" badge="{{ $collectTotal }}"
                badge-classes="badge-primary" responsive />
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra table-compact hover:table-zebra-hover">
            <!-- head -->
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Modelo ONU</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($collectData as  $collect)
                    <tr wire:key="cliente-{{ $collect->cliente_id }}">
                        <td>
                            <a target="blank"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{{ $collect->cliente_id }}/edit/">
                                {{ $collect->nome }}

                            </a>
                        </td>
                        <td> {{ $collect->onutype }} </td>
                        <td>{{ $collect->logradouro }}</td>
                        <td>{{ $collect->bairro }}</td>
                        <td>{{ $collect->cidade }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($collect->data_alteracao)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            <p class="text-lg dark:text-gray-200 text-gray-800">Nenhum registro</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
