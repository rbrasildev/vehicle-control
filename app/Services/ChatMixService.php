<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatMixService
{
    protected $token = "2441-6A5-2FD11-3C464";
    protected $key = "SMSCXNET-E4DF99";
    protected $url = "https://api.chatmix.com.br/v2/";

    public function sendMessage($message, $destinatario)
    {
        $data = [
            "token" => $this->token,
            "key" => $this->key,
            "numero" => $destinatario,
            "mensagem" => $message,
            "agendamento" => "sim",
            "ignorar_limite_md" => "sim"
        ];

        $response = Http::withoutVerifying()
            ->asForm()
            ->post($this->url, $data);

        return $response->json();
    }
}
