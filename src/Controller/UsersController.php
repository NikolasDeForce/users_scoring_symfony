<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Src\Scoring\Scoring;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/users')]
final class UsersController extends AbstractController
{
    #[Route(name: 'app_users_index', methods: ['GET'])]
    public function index(UsersRepository $users, PaginatorInterface $paginator, Request $request): Response
    {
        $user = new Users();
        $pagination = $paginator->paginate(
            $users->findByUserField($user), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            5 /* limit per page */
        );
    
        // parameters to template
        return $this->render('users/index.html.twig', ['pagination' => $pagination]);
    }

    #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user_add = Scoring::scoring($user, $form);

            $entityManager->persist($user_add);
            $entityManager->flush();

            
            return $this->redirectToRoute('app_users_index', []);
        }
        
        return $this->render('users/new.html.twig', [
            'form' => $form,
            'user'=> $user,
        ]);
    }  

    #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(Users $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Users $user, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(UsersType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = Scoring::scoring($user, $form);

            $entityManager->flush();
            
            return $this->redirectToRoute('app_users_index');
        }

        return $this->render('users/edit.html.twig', [
            'form' => $form,
            'user'=> $user,
        ]);
    }

    #[Route('/{id}', name: 'app_users_delete', methods: ['POST'])]
    public function delete(Request $request, Users $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }
}
