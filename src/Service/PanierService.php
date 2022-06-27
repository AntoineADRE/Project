<?php

namespace App\Service;

use App\Repository\ProduitRepository;
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

    public function supprimeProduit(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    public function getPanier()
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

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getPanier() as $item) {
            $total += $item['produit']->getPrix() * $item['quantite'];
        }
        return $total;
    }
}
