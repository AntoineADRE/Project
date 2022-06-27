<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    protected $session;
    protected $produitRepository;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
    }

    public function ajouteProduit(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $this->session->set('panier', $panier);
    }

    public function supprimerProduit(int $id)
    {
        //TO DO
    }

    public function montrePanier()
    {
        $panier = $this->session->get('panier', []);
        $panierAvecDonnees = [];
        foreach ($panier as $id => $quantite) {
            $panierAvecDonnees[] = [
                'produit' => $this->produitRepository->find($id),
                'quantite' => $quantite
            ];
        }


        return $panierAvecDonnees;
    }
}
