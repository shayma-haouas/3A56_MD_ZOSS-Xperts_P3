<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\DechetsRepository;
use App\Entity\Dechets;
use App\Form\DechetsType;

use App\Entity\ReservationDechets;
use App\Form\ReservationDechetsType;
use App\Repository\ReservationDechetsRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;



class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('front/Base-front.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/listedechets', name: 'product_list')]
    public function find(DechetsRepository $productRepository): Response
    {
        $dechet = $productRepository->findAll();

        // Now you can pass $products to a template, or return a JSON response, etc.
        return $this->render('front/list_dechet.html.twig', [
            'dechet' => $dechet,
        ]);
    }


    #[Route('/reserver/{id}', name: 'app_reserver')]
    public function new(Request $request, EntityManagerInterface $entityManager , DechetsRepository $dechets , $id ): Response
    {
        $dechet = $dechets->find($id);
        $reservationDechet = new ReservationDechets();
        $form = $this->createForm(ReservationDechetsType::class, $reservationDechet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationDechet);
            $entityManager->flush();
            return $this->redirectToRoute('product_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/reserver.html.twig', [
            'reservation_dechet' => $reservationDechet,
            'dechet' => $dechet ,
            'form' => $form,
        ]);
    }
    
    
   


}
