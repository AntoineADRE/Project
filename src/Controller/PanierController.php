<?php

namespace App\Controller;

use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/panier', name: 'app_panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PanierService $panierService): Response
    {
       
        return $this->render('panier/index.html.twig', [
            'items' => $panierService->getPanier(),
            'total' => $panierService->getTotal()
        ]);
    }

    #[Route('/ajouter/{id}', name: 'ajouter')]
    public function ajouter(int $id, PanierService $panierService): Response
    {
        $panierService->ajouteProduit($id);
        return $this->redirectToRoute('app_panier_index');
    }
    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function supprimer(int $id, PanierService $panierService): Response
    {
        $panierService->supprimeProduit($id);
        return $this->redirectToRoute('app_panier_index');
    }

}
