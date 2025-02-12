<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\ChatMixService;

class SendBirthdayMessages extends Command
{
    protected $signature = 'send:birthday-messages';
    protected $description = 'Envia SMS para aniversariantes';

    protected $chatMixService;

    public function __construct(ChatMixService $chatMixService)
    {
        parent::__construct();
        $this->chatMixService = $chatMixService;
    }

    public function handle()
    {
        $connections = ['sgptins', 'sgpanp', 'sgp'];

        foreach ($connections as $connection) {
            $this->sendMessagesForConnection($connection);
        }
    }

    protected function sendMessagesForConnection($connection)
    {
        $today = Carbon::now()->format('m-d');

        $aniversariantes = DB::connection($connection)
            ->table('admcore_contato')
            ->join('admcore_clientecontato', 'admcore_contato.id', '=', 'admcore_clientecontato.contato_id')
            ->join('admcore_cliente', 'admcore_cliente.id', '=', 'admcore_clientecontato.cliente_id')
            ->join('admcore_pessoa', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->select('admcore_contato.tipo', 'admcore_contato.contato', 'admcore_pessoa.nome', 'admcore_pessoa.datanasc')
            ->where('admcore_contato.tipo', 'CELULAR_PESSOAL')
            ->whereRaw("TO_CHAR(admcore_pessoa.datanasc, 'MM-DD') = ?", [$today])
            ->get();

        foreach ($aniversariantes as $user) {
            $message = "Olá, {$user->nome}, Tudo bem? 🥰 " . PHP_EOL .
                "Sou a Ivanna da ConexãoNet e estou aqui para lhe afirmar que você é muito importante para nós, por isso que nesse dia tão especial, não poderíamos deixar de lembrar de você😊 " . PHP_EOL .
                "Todos aqui da ConexãoNet estão passando para te desejar toda a felicidade do mundo 🥳🎂 " . PHP_EOL .
                "Que você tenha um grande dia ao lado dos seus amigos e familiares e que este dia se repita por muitos anos. Aproveita 🎉🎉 " . PHP_EOL .
                "Um grande abraço da família ConexãoNet 😊";

            try {
                $response = $this->chatMixService->sendMessage($message, $user->contato);

                if ($response['success']) {
                    $this->info("SMS enviado para: {$user->nome} ({$user->contato}) na conexão {$connection}");
                } else {
                    $this->error("Falha ao enviar SMS para: {$user->nome} na conexão {$connection}");
                }
            } catch (\Exception $e) {
                $this->error("Erro ao enviar SMS para {$user->nome} na conexão {$connection}: " . $e->getMessage());
            }
        }
    }
}
