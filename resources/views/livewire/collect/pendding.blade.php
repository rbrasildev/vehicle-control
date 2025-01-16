    @php
        $headers = [
            ['key' => 'onutype', 'label' => 'ONU', 'class'=>'w-48'],
            ['key' => 'username', 'label' => 'Tecnico'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'servicoprestado', 'label' => 'Serviço prestado'],
            ['key' => 'data_finalizacao', 'label' => 'Data finalização', 'format' => ['date', 'd/m/Y']],
        ];
    @endphp
    <div>
        <x-mary-table :headers="$headers" :rows="$pendding" striped
            link="https://{{ session('currentConnection') }}.redeconexaonet.com/admin/cliente/{cliente_id}/edit">
        </x-mary-table>
    </div>
