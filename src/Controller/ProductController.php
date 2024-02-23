<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product', name: 'app_product')]

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    
    public function index(): Response
    {
        $produit = $this->getDoctrine()->getRepository(produit::class)->findAll();
        return $this->render('front/product.html.twig', [
            'produits' => $produit,
        ]);
    }
   
}
