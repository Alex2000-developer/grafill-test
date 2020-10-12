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
use App\Service\CasualNumberGenerator;

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
     * @Route("/prova-doctrine", name="users_doctrine")
     */
    public function provaDoctrine(UsersRepository $usersRepository): Response
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
     * @Route("/crea-utenti", name="crea_utenti", methods={"GET","POST"})
     */
    public function creaUtenti(Request $request, UsersRepository $usersRepository  , GroupsRepository $groupsRepository): Response
    {
        //Extract entity object
        $groups = $groupsRepository->findBy(['id' => 1]);
        $users_saved = 0;
        $message = '';
        $casual_number_object = new CasualNumberGenerator;
        
        for($i = 1; $i<=3; $i++){
            $casual_number_generated = $casual_number_object->getCasualNumber();
            $user_entity = new Users();
            $user_entity->setName('user_name'.$casual_number_generated);
            $user_entity->setSurname('user_surname'.$casual_number_generated);
            $user_entity->setEmail('user_'.$casual_number_generated.'@gmail.com');
            $user_entity->setUserGroup($groups[0]);
            // dump($user_entity);die();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user_entity);
            $users_saved++;
        }
        $entityManager->flush();
        $message = 'OK'.' | Utenti salvati: '.$users_saved;
        return $this->render('users/crea-utenti.html.twig', [
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
