<div>
    @if (session('currentConnection') == 'sgp')
        <a target="_blank" href="https://sgp.redeconexaonet.com.br" class="text-primary">Pacajá</a>
    @elseif(session('currentConnection') == 'sgptins')
        <a target="_blank" href="https://sgptins.redeconexaonet.com" class="text-primary">Parintins</a>
    @elseif(session('currentConnection') === 'sgpanp')
        <a target="_blank" href="https://sgpanp.redeconexaonet.com" class="text-primary">Anapu</a>
    @endif
</div>
