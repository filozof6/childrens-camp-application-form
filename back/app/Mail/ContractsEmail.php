<?php

namespace App\Mail;

class ContractsEmail extends AbstractEmail
{
    public $subject = 'Zmluvné dokumenty';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $builder = $this->view('emails.contractsEmail');
        $this->attachFiles($builder);
        $builder->attach(storage_path() . '/app/email2Prilohy/vseobecne_podmienky_poskytovania_sluzieb_smajlovo.pdf');
        $builder->attach(storage_path() . '/app/email2Prilohy/cennik_taborov_smajlovo.pdf');

        return $builder;
    }
}