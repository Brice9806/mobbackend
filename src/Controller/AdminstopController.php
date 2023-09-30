<?php

namespace App\Controller;

use App\Entity\Stop;
use App\Form\StopType;
use App\Repository\StopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminstop')]
class AdminstopController extends AbstractController
{
    #[Route('/', name: 'app_adminstop_index', methods: ['GET'])]
    public function index(StopRepository $stopRepository): Response
    {
        return $this->render('adminstop/index.html.twig', [
            'stops' => $stopRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adminstop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $stop = new Stop();
        $form = $this->createForm(StopType::class, $stop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stop);
            $entityManager->flush();

            return $this->redirectToRoute('app_adminstop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminstop/new.html.twig', [
            'stop' => $stop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adminstop_show', methods: ['GET'])]
    public function show(Stop $stop): Response
    {
        return $this->render('adminstop/show.html.twig', [
            'stop' => $stop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adminstop_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Stop $stop, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StopType::class, $stop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adminstop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminstop/edit.html.twig', [
            'stop' => $stop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adminstop_delete', methods: ['POST'])]
    public function delete(Request $request, Stop $stop, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stop->getId(), $request->request->get('_token'))) {
            $entityManager->remove($stop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adminstop_index', [], Response::HTTP_SEE_OTHER);
    }
}
