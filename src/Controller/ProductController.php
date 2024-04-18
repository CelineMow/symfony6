<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/product/add', name: 'app_add_product')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        // charger le formulaire
        $product = new Product(); // nouvelle entite;
        $form = $this->createForm(ProductType::class, $product); // le type du formulaire;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('app_product'); // renvoyer le formulaire
        }
        //primo rendu
        return $this->render('product/add.html.twig', [
            'form' => $form->createView(),
        ]); // renvoyer le formulaire
    }
}
