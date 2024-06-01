<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Uid\Uuid;

#[Route('/training')]
class TrainingController extends AbstractController
{
    public function __construct(private TrainingRepository $trainingRepository)
    {
    }

    #[Route('/', name: 'training_list', methods: ['GET'])]
    public function list(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $trainings = $this->getUser()->getTrainings();

        return $this->render('training/list.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    #[Route('/create', name: 'training_create')]
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        // TODO

        return $this->render('exercise/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/training/{id}', name: 'training_show')]
    public function show(Uuid $id): Response
    {
        return $this->render('training/show.html.twig', [
            'training' => $this->trainingRepository->find($id),
        ]);
    }

    public function edit(): Response
    {
        // TODO
        return $this->render('training/list.html.twig');
    }

    public function delete(): Response
    {
        // TODO
        return $this->render('training/list.html.twig');
    }
}
