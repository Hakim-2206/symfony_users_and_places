<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthorizationCheckerInterface $authorizationChecker): Response
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setName($form->get('name')->getData());
            $user->setFirstname($form->get('firstname')->getData());
            $user->setAvatar($form->get('avatar')->getData());
            $user->setUsername($form->get('username')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));

           
                $user->setRoles(['ROLE_USER']);

                $entityManager->persist($user);
                $entityManager->flush();
            
            
            return $this->redirectToRoute('app_front');
        }


        

        return $this->render('registration/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
