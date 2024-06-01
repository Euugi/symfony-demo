<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserDetailsType;
use App\Service\BMICalculatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/profile', name: 'user_profile_show', methods: ['GET'])]
    public function showProfile(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return new Response(
            $this->renderView('user/profile/show.html.twig')
        );
    }

    #[Route('/user/profile/edit', name: 'user_profile_edit')]
    public function editProfile(
        Request $request,
        EntityManagerInterface $entityManager,
        BMICalculatorService $BMICalculatorService
    ): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userProfile = $this->getUser()->getUserProfile();

        $form = $this->createForm(UserDetailsType::class, $userProfile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userProfile = $form->getData();
            $bmi = $BMICalculatorService->calculate($form->getData()->getWeight(), $form->getData()->getHeight());
            $userProfile->setBmi($bmi);
            $entityManager->flush();

            return $this->redirectToRoute('user_profile_edit');
        }

        return $this->render('/user/profile/edit.html.twig', [
            'form' => $form,
            'bmi' => $this->getUser()->getUserProfile()->getBMI(),
        ]);
    }

    #[Route('/user/profile/delete', name: 'user_profile_delete')]
    public function deleteProfile(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());

        $entityManager->remove($user);
        $entityManager->flush();

        return new Response(
            $this->renderView('home/index.html.twig')
        );
    }
}
