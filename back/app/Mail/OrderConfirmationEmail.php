<?php

namespace App\Mail;

class OrderConfirmationEmail extends AbstractEmail
{
    public $subject = 'Objednávka detského tábora SMAJLOVO';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $builder = $this->view('emails.orderConfirmationEmail');
        $this->attachFiles($builder);
        $builder->attach(storage_path() . '/app/email1Prilohy/co_si_zobrat_do_tabora_smajlovo.pdf');
        return $builder;
    }
}