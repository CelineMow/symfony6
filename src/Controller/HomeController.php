<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use App\Service\PHPMailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Controller de page Accueil',
        ]);
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'Controller de page Contact',
            'coordonnees1' => [
                "Nom" => "Morel",
                "Prénom" => "Céline",
                "Adresse" => "1 rue Jean Goujon 31500 Toulouse",
            ],

            'coordonnees2' => [
                "Nom" => "Huynh",
                "Prénom" => "Yvon",
                "Adresse" => "14 rue du Tibet, 31100 Toulouse",
            ]
        ]);
    }

    #[Route('/mail', name: 'app_mail')]
    public function mail(MailerInterface $mailer): Response
    {
        $email = new Email();
        $email->from('symfony6@gmail.com')
            ->to('celine.pro.morel@gmail.com')
            ->subject('test email symfony')
            ->text('test email test')
            ->html('<h2>Test email</h2>');

        $mailer->send($email);

        return $this->render(
            'home/email.html.twig',
            [
                'controller_name' => 'envoi réussi',

            ]
        );
    }

    #[Route('/phpmail', name: 'app_phpmail')]
    public function phpmail(PHPMailService $mail): Response
    {
        //envoi du mail

        $mail->setFrom('from@gmail.com', 'Mailer');
        $mail->addAddress('celine.pro.morel@gmail.com', 'Joe User');

        $mail->isHTML(true);
        $mail->Subject = 'test phpmail symfony';
        $mail->Body = 'test <b>email</b> test';

        $mail->send();

        return $this->render(
            'home/email.html.twig',
            [
                'controller_name' => 'envoi réussi',

            ]
        );
    }


    #[Route('/service', name: 'app_service')]
    public function service(MessageGenerator $msg): Response
    {


        return $this->render(
            'home/email.html.twig',
            [
                'controller_name' => $msg->getHappyMessage(),

            ]
        );
    }
}
