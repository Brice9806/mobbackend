<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Form\MagasinType;
use App\Repository\MagasinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminmagasin')]
class AdminmagasinController extends AbstractController
{
    #[Route('/', name: 'app_adminmagasin_index', methods: ['GET'])]
    public function index(MagasinRepository $magasinRepository): Response
    {
        return $this->render('adminmagasin/index.html.twig', [
            'magasins' => $magasinRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adminmagasin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $magasin = new Magasin();
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($magasin);
            $entityManager->flush();

            return $this->redirectToRoute('app_adminmagasin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminmagasin/new.html.twig', [
            'magasin' => $magasin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adminmagasin_show', methods: ['GET'])]
    public function show(Magasin $magasin): Response
    {
        return $this->render('adminmagasin/show.html.twig', [
            'magasin' => $magasin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adminmagasin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Magasin $magasin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adminmagasin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminmagasin/edit.html.twig', [
            'magasin' => $magasin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adminmagasin_delete', methods: ['POST'])]
    public function delete(Request $request, Magasin $magasin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magasin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($magasin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adminmagasin_index', [], Response::HTTP_SEE_OTHER);
    }
}
