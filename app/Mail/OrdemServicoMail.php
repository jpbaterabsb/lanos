<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdemServicoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $dataOs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataOs)
    {
        $this->dataOs = $dataOs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $pdf = PDF::loadView('pdf.ordem-servico',$this->dataOs)->setPaper('a4');
        return $this->view('mail.ordem-servico',$this->dataOs)
            ->subject('Ordem Serviço '.date('d/m/Y'))
            ->attachData($pdf->output(),'ordem-servico.pdf');
    }
}
