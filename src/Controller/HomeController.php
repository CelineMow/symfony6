<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
