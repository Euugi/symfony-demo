<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $user = $form->getData();
                $user->setPassword($passwordHasher->hashPassword($user, $form->getData()->getPassword()));
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Registration complete, please confirm your account.');

                return $this->redirectToRoute('login');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'Registration failed, please register again making sure your details are correct.'
                );

                return $this->redirectToRoute('register');
            }
        }

        return $this->render('register/register.html.twig', [
            'form' => $form,
        ]);
    }
}
