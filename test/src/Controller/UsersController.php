<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use App\Repository\GroupsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="users_index", methods={"GET"})
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }
    /**
     * @Route("/lista_rand", name="users_lista")
     */
    public function lista_rand(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->getListRand(),
        ]);
    }
    /**
     * @Route("/new", name="users_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);
        
        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($user);
            $entityManager->flush();
            
            // return $this->redirectToRoute('users_index');
        }

        return $this->render('users/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/crea_utenti", name="crea_utenti", methods={"GET","POST"})
     */
    public function crea_utenti(Request $request, UsersRepository $usersRepository  , GroupsRepository $groupsRepository): Response
    {
        //Extract entity object
        $groups = $groupsRepository->findBy(['id' => 1]);
        $users_saved = 0;
        $message = '';
        for($i = 1; $i<=3; $i++){
            $user_entity = new Users();
            $user_entity->setName('user_'.$i.'_name');
            $user_entity->setSurname('user_'.$i.'_surname');
            $user_entity->setEmail('user_'.$i.'_surname@gmail.com');
            $user_entity->setUserGroup($groups[0]);
            // dump($user_entity);die();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user_entity);
            $users_saved++;
        }
        $entityManager->flush();
        $message = 'OK'.' | Utenti salvati: '.$users_saved;
        return $this->render('users/crea_utenti.html.twig', [
            'user' => $user_entity,
            'message' => $message,
        ]);
    }

    /**
     * @Route("/{id}", name="users_show", methods={"GET"})
     */
    public function show(Users $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $user): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index');
    }
}
