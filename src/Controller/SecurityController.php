<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class SecurityController extends AbstractController
{
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {

         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('login.html.twig', [
             'last_username' => $lastUsername,
             'error'         => $error,
          ]);
    }

    public function logout(): void
    {
        //nothing to do, it's magic!
    }
}
