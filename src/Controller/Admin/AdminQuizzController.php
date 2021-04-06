<?php

namespace App\Controller\Admin;

use App\Controller\NomRoute;
use App\Entity\Quizz;
use App\Form\Admin\QuizzType;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/quizz')]
class AdminQuizzController extends AbstractController
{
    #[Route('/', name: NomRoute::ADMIN_QUIZZ_INDEX, methods: ['GET'])]
    public function index(QuizzRepository $quizzRepository): Response
    {
        return $this->render('admin/quizz/index.html.twig', [
            'quizzs' => $quizzRepository->findAll(),
        ]);
    }

    #[Route('/new', name: NomRoute::ADMIN_QUIZZ_NEW, methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $quizz = new Quizz();
        $form = $this->createForm(QuizzType::class, $quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quizz);
            $entityManager->flush();

            return $this->redirectToRoute(NomRoute::ADMIN_QUIZZ_INDEX);
        }

        return $this->render('admin/quizz/new.html.twig', [
            'quizz' => $quizz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: NomRoute::ADMIN_QUIZZ_SHOW, methods: ['GET'])]
    public function show(Quizz $quizz): Response
    {
        return $this->render('admin/quizz/show.html.twig', [
            'quizz' => $quizz,
        ]);
    }

    #[Route('/{id}/edit', name: NomRoute::ADMIN_QUIZZ_EDIT, methods: ['GET', 'POST'])]
    public function edit(Request $request, Quizz $quizz): Response
    {
        $form = $this->createForm(QuizzType::class, $quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(NomRoute::ADMIN_QUIZZ_INDEX);
        }

        return $this->render('admin/quizz/edit.html.twig', [
            'quizz' => $quizz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: NomRoute::ADMIN_QUIZZ_DELETE, methods: ['POST'])]
    public function delete(Request $request, Quizz $quizz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizz->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quizz);
            $entityManager->flush();
        }

        return $this->redirectToRoute(NomRoute::ADMIN_QUIZZ_INDEX);
    }
}
