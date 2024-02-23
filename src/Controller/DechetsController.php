<?php

namespace App\Controller;

use App\Entity\Dechets;
use App\Form\DechetsType;
use App\Repository\DechetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dechets')]
class DechetsController extends AbstractController
{
    #[Route('/', name: 'app_dechets_index', methods: ['GET'])]
    public function index(DechetsRepository $dechetsRepository): Response
    {
        return $this->render('dechets/index.html.twig', [
            'dechets' => $dechetsRepository->findAll(),
        ]);
    }

    #[Route('/back/new', name: 'app_dechets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dechet = new Dechets();
        $form = $this->createForm(DechetsType::class, $dechet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($dechet);
            $entityManager->flush();

            return $this->redirectToRoute('app_dechets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/Adechet.html.twig', [
            'dechet' => $dechet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dechets_show', methods: ['GET'])]
    public function show(Dechets $dechet): Response
    {
        return $this->render('dechets/show.html.twig', [
            'dechet' => $dechet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dechets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dechets $dechet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DechetsType::class, $dechet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dechets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dechets/edit.html.twig', [
            'dechet' => $dechet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dechets_delete', methods: ['POST'])]
    public function delete(Request $request, Dechets $dechet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dechet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($dechet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dechets_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/products', name: 'product_list')]
    public function find(DechetsRepository $productRepository): Response
    {
        $dechet = $productRepository->findAll();

        // Now you can pass $products to a template, or return a JSON response, etc.
        return $this->render('front/list_dechet.html.twig', [
            'dechet' => $dechet,
        ]);
    }
}
