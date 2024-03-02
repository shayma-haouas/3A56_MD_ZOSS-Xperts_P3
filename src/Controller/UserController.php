<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UsernewType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository,PaginatorInterface $paginator, Request $request): Response
    {
        // Utiliser dump() pour afficher les données des utilisateurs dans le terminal
        dump($userRepository->findAll());
         // Récupérez l'utilisateur connecté
         $user = $this->getUser();

    $queryBuilder = $userRepository->createQueryBuilder('a')
        ->orderBy('a.name', 'DESC');

    $searchTerm = $request->query->get('q');
    if ($searchTerm) {
        $queryBuilder
            ->where('a.name LIKE :term')
            ->setParameter('term', '%' . $searchTerm . '%');
    }

    $query = $queryBuilder->getQuery();

    $user = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        2
    );

        // Passer les données des utilisateurs à la vue
        return $this->render('user/base.html.twig', [
            'user' => $user,
            'users' => $userRepository->findAll(),
        ]);
     
   

    }


    #[Route('/user/{id}', name: 'app_user_show')]
    public function show(User $user): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'disabled' => true, 
        ]);

        return $this->render('user/showuser.html.twig', [
            'user' => $user,
            'form' => $form->createView(), 
        ]);
    }

    #[Route('/user/delete/{id}', name: 'app_user_delete')]
    public function delete(User $user, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('app_user');
    }

    #[Route('/user/update/{id}', name: 'app_user_update')]
    public function update(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->flush();
            return $this->redirectToRoute('app_user');
        }
        return $this->render('user/updateuser.html.twig', [
            'user' => $user, 
            'form' => $form->createView(),
        ]);

    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        
        $user = new User();
        $form = $this->createForm(UsernewType::class, $user); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager->persist($user); 
            $entityManager->flush();

        
            $this->addFlash('success', 'User successfully added!');

            
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER); 
        }

        // Rendre le formulaire et la vue associée
        return $this->renderForm('user/newuser.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
