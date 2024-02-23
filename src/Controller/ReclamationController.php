<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/back', name: 'app_reclamation_indexback', methods: ['GET'])]
    public function indexback(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository,EntityManagerInterface $entityManager): Response
    {
        $id = 1 ;
        $reclamations = $entityManager
                ->getRepository(Reclamation::class)
                ->findByUserId($id);
        return $this->render('reclamation/indexfront.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation,EntityManagerInterface $entityManager): Response
    {
        $reclamationId = $reclamation->getId();
        $reponses = $entityManager
        ->getRepository(Reponse::class)
        ->findResponsesByReclamationId($reclamationId);
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
            'reponses' => $reponses,
        ]);
    }
    #[Route('/reclamation/{id}/back', name: 'app_reclamation_showback', methods: ['GET'])]
    public function showback(Reclamation $reclamation ,EntityManagerInterface $entityManager): Response
    {
        // Retrieve associated Reponses by Reclamation id
        $reclamationId = $reclamation->getId();
        $reponses = $entityManager
                ->getRepository(Reponse::class)
                ->findResponsesByReclamationId($reclamationId);

        return $this->render('reclamation/showback.html.twig', [
            'reclamation' => $reclamation,
            'reponses' => $reponses,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }


  

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/delete/back', name: 'app_reclamation_deleteback', methods: ['POST'])]
    public function deleteback(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_indexback', [], Response::HTTP_SEE_OTHER);
    }
}
