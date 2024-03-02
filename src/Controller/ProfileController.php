<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        // Fetch the authenticated user
        $user = $this->getUser();

        // Render the profile page template and pass the user information
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
