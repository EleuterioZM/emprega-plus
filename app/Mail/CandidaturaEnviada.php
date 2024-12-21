<?php

namespace App\Mail;

use App\Models\Candidatura;
use App\Models\JobPost;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidaturaEnviada extends Mailable
{
    use Queueable, SerializesModels;

    public $candidatura;
    public $jobPost;

    public function __construct(Candidatura $candidatura, JobPost $jobPost)
    {
        $this->candidatura = $candidatura;
        $this->jobPost = $jobPost;
    }

    public function build()
    {
        $email = $this->view('emails.candidatura')
                      ->subject('Nova Candidatura Recebida');

        // Verificar se a carta de candidatura é um arquivo e anexá-la
        if ($this->candidatura->carta_candidatura) {
            // Se for um arquivo
            if (is_file(storage_path('app/public/' . $this->candidatura->carta_candidatura))) {
                $email->attach(storage_path('app/public/' . $this->candidatura->carta_candidatura), [
                    'as' => 'Carta_Candidatura.pdf',
                    'mime' => 'application/pdf',  // Pode ajustar conforme o tipo de arquivo
                ]);
            } else {
                $email->with([
                    'carta_candidatura' => $this->candidatura->carta_candidatura,
                ]);
            }
        }

        // Verificar se há anexo e anexá-lo
        if ($this->candidatura->anexo) {
            $email->attach(storage_path('app/public/' . $this->candidatura->anexo), [
                'as' => 'Anexo.pdf',  // Ajuste o nome conforme necessário
                'mime' => 'application/pdf',  // Ou ajuste conforme o tipo de arquivo
            ]);
        }

        return $email;
    }
}
