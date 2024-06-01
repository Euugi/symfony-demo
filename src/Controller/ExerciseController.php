<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Exercise;
use App\Form\ExerciseType;
use App\Repository\ExerciseRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class ExerciseController extends AbstractController
{
    public function __construct(private ExerciseRepository $exerciseRepository, private LoggerInterface $logger)
    {
    }

    #[Route('/exercise/create', name: 'exercise_create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        FileUploader $fileUploader
    ): Response {
        $exercise = new Exercise();
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request);

        if (true === $form->isSubmitted() && true === $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('imageFile')->getData();

            try {
                $newFilename = $fileUploader->upload($imageFile);
                $exercise->setImageFile($newFilename);
            } catch (FileException $e) {
                $this->logger->error('Error uploading the exercise photo file.');
            }

            $entityManager->persist($exercise);
            $entityManager->flush();

            return $this->redirectToRoute('exercises_list');
        }

        return $this->render('exercise/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/exercise/{id}', name: 'exercise_show')]
    public function show(Uuid $id): Response
    {
        return $this->render('exercise/show.html.twig', [
            'exercise' => $this->exerciseRepository->find($id),
        ]);
    }

    public function edit(): void
    {
        // TODO
    }

    #[Route('/exercise/delete/{id}', name: 'exercise_delete')]
    public function delete(): void
    {
        // TODO
    }

    #[Route('/exercises', name: 'exercises_list')]
    public function list(): Response
    {
        return $this->render('exercise/list.html.twig', [
            'exercises' => $this->exerciseRepository->findAll(),
        ]);
    }
}
