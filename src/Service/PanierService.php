<?php

namespace App\Service;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    protected $session;
    protected $produitRepository;
    protected $stripeService;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository, StripeService $stripeService)
    {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
        $this->stripeService = $stripeService;
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

    public function intentSecret(){
        $intent = $this->stripeService->paymentIntent($this->getTotal());
    }

    public function stripe(array $stripeParameter){
        $resource =  null;
    $data = $this->stripeService->payment($this->getTotal(), 'eur', $this->getPanier(), $stripeParameter);

    if($data){
        $resource = [
            'stripeBrand'=>$data['charges']['data'][0]['payment_method_details']['card']['brand'],
        'stripeLast4'=>$data['charges']['data'][0]['payment_method_details']['card']['last4'],
        'stripeId'=>$data['charges']['data']['id'],
        'stripeStatus'=>$data['charges']['data'][0]['status'],
        'stripeToken'=>$data['client_secret'],
        ];
        
    }
    return $resource;
    }

    //TO DO
}
