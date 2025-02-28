<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/film')]
final class FilmController extends AbstractController
{
    #[Route(name: 'app_film',methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }

        #[Route('/new', name: 'app_film_new', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager): Response
        {
            $user = new Film();
            $form = $this->createForm(FilmType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_film_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('film/new.html.twig', [
                'user' => $user,
                'form' => $form,
            ]);
        }
}