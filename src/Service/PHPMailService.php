<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;

class PHPMailService extends \PHPMailer\PHPMailer\PHPMailer
{
    public function __construct()
    {
        //configuration du mailer
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->SMTPAuth = true;
        $this->Username = 'celine.pro.morel@gmail.com';
        $this->Password = 'xnsufirmaiaedmmq';
        $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->Port = 587; // j'ai du changer le port, pourquoi ?

    }
}
