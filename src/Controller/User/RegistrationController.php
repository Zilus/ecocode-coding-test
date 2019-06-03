<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\User\RegistrationType;
use App\Service\User\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class RegistrationController extends AbstractController
{
    public function create(
        Manager $userManager,
        Request $request,
        TokenStorageInterface $tokenStorage,
        Session $session
    ) {
        $form = $this->createForm(RegistrationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // set confirmation token
            $user = $form->getData();
            $userManager->updatePassword($user);
            $userManager->saveUser($user);

            // authenticate created user
            $token = new UsernamePasswordToken($user, $user->getPassword(), 'app_user_provider', $user->getRoles());
            $tokenStorage->setToken($token);
            $session->set(User::FIRST_LOGIN_FLAG, true);

            // redirect to thanks page
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('user/registration.html.twig', ['form' => $form->createView()]);
    }
}
