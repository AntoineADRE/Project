<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SousCategorieController extends AbstractController
{
    #[Route('/souscategorie', name: 'app_sous_categorie')]
    public function index(): Response
    {
        return $this->render('sous_categorie/index.html.twig', [
            'controller_name' => 'SousCategorieController',
        ]);
    }
}