<?php

namespace App\Controller;

use App\Entity\FactureDon;
use App\Form\FactureDonType;
use App\Repository\FactureDonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/facture/don')]
class FactureDonController extends AbstractController
{
    #[Route('/', name: 'app_facture_don_index', methods: ['GET'])]
    public function index(FactureDonRepository $factureDonRepository): Response
    {
        return $this->render('facture_don/index.html.twig', [
            'facture_dons' => $factureDonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_facture_don_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $factureDon = new FactureDon();
        $form = $this->createForm(FactureDonType::class, $factureDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($factureDon);
            $entityManager->flush();

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_don/new.html.twig', [
            'facture_don' => $factureDon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_facture_don_show', methods: ['GET'])]
    public function show(FactureDon $factureDon): Response
    {
        return $this->render('facture_don/show.html.twig', [
            'facture_don' => $factureDon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_facture_don_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FactureDon $factureDon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FactureDonType::class, $factureDon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_facture_don_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facture_don/edit.html.twig', [
            'facture_don' => $factureDon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_facture_don_delete', methods: ['POST'])]
    public function delete(Request $request, FactureDon $factureDon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factureDon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($factureDon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_facture_don_index', [], Response::HTTP_SEE_OTHER);
    }
}
