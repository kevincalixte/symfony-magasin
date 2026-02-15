<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\CommandeProduitRepository;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $pr,  CommandeProduitRepository $cpr, CommandeRepository $cr): Response
    {
        $produits = $pr->findAll();
        $client = $this->getUser();
        $isAdmin = false;
        if ($client instanceof Client && in_array('ROLE_ADMIN', $client->getRoles())) {
            $isAdmin = true;
        }
        $total_vendu = $cpr->topTrois();
        $chiffreAffaireParProduit = $cpr->chiffreAffaireParProduit();
        $chiffreAffaireParclient = $cpr->chiffreAffaireParClient();
        $total_commande_mois = $cr->commandeDuMois();
        // $exercice = $cr->exercice();
        // $exercice = $cpr->exercice();
        // dd($exercice);
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'isAdmin' => $isAdmin,
            'caProduit' => $chiffreAffaireParProduit,
            'caClient' => $chiffreAffaireParclient,
            'total_vendu' => $total_vendu,
            'total_commande_mois' => $total_commande_mois,
        ]);
    }


}
