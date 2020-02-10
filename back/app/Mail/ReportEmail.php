<?php

namespace App\Mail;

class ReportEmail extends AbstractEmail
{
    public $subject = 'Evidencia objednávok tábor SMAJLOVO';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $builder = $this->view('emails.reportEmail');
        $this->attachFiles($builder);
        return $builder;
    }
}