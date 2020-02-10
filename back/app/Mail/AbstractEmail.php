<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

abstract class AbstractEmail extends Mailable
{
    public $attachmentsArray;

    /**
     * OrderConfirmationEmail constructor.
     * @param $attachments
     */
    public function __construct($attachments)
    {
        $this->attachmentsArray = $attachments;
    }

    /**
     * Build the message.
     *
     * @param $builder
     */
    public function attachFiles(&$builder)
    {
        foreach ($this->attachmentsArray as $filePath) {
            $builder->attach($filePath);
        }
    }
}