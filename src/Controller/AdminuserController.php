<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminuser')]
class AdminuserController extends AbstractController
{
    #[Route('/', name: 'app_adminuser_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('adminuser/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adminuser_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher ): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword=$form->get('plainPassword')->getData();
            $hashPassword=$passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_adminuser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminuser/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adminuser_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('adminuser/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adminuser_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword=$form->get('plainPassword')->getData();
            $hashPassword=$passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashPassword);
            $entityManager->flush();

            return $this->redirectToRoute('app_adminuser_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminuser/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adminuser_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adminuser_index', [], Response::HTTP_SEE_OTHER);
    }

}
