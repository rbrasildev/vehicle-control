<div>
    <div class="flex gap-2">
        <x-mary-datetime class="max-w-48" wire:model.live="date" icon="o-calendar" />
        @if (session('currentConnection') == 'sgptins')
            <x-mary-choices-offline class="w-48" wire:model.live="currentPop" :options="$pops"
                placeholder="Selecione ..." single />
        @endif

    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>Número OS</th>
                    <th>Nome do cliente</th>
                    <th>Cidade</th>
                    <th>Motivo OS</th>
                    <th>Problema / Serviço</th>
                    <th>Solução / Serviço prestado</th>
                    <th>Equipe</th>
                    <th>Data</th>
                    <th>Fotos</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($audit as $item)
                    <tr>
                        <td><a href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/atendimento/ocorrencia/os/<?= $item->os_id ?>/edit/"
                                class="cursor-pointer" target="blank"><?= $item->numero_ocorrencia ?></a></td>
                        <td> <a href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/<?= $item->id ?>/edit/"
                                class="cursor-pointer" target="blank"><?= $item->nome ?></a></td>
                        <td><?= $item->cidade ?></td>
                        <td><?= $item->descricao ?></td>
                        <td><?= $item->conteudo ?></td>
                        <td>
                            <p class="text-wrap text-muted"><?= $item->servicoprestado ?></p>
                        </td>
                        <td><?= $item->username ?></td>
                        <td><?= date('d/m/Y', strtotime($item->data_finalizacao)) ?></td>
                        <td><a class="flex gap-2 text-primary flex-row"
                                href="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/atendimento/ocorrencia/<?= $item->ocorrencia_id ?>/anexo/list/">Anexos</a>
                        </td>
                    @empty
                        <td>
                            Nenhum registro
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
