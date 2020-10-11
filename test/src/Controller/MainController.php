<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use App\Service\CasualNumberGenerator;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/prova-twig/{name}", name="prova_twig")
     */
    public function provaTwig($name){
        
        return $this->render('main/prova-twig.html.twig', [
            'controller_name' => 'MainController',
            'name' => $name,
        ]);
    }
    /**
     * @Route("/stampa-ora/", name="stampa_ora")
     */
    public function stampaOra(){
        
        return $this->render('main/stampa-ora.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/prova-symfony", name="prova_sympfony")
     */
    public function provaSymfony(CasualNumberGenerator $casual_number){
        
        return $this->render('main/prova-symfony.html.twig', [
            'controller_name' => 'MainController',
            'casual_number' => $casual_number->getCasualNumber(),
        ]);
    }
    /**
     * @Route("/crea-utenti", name="crea-utenti")
     */
    public function creaUtenti(CasualNumberGenerator $casual_number){
        
        return $this->redirect('/users/crea-utenti');
    }
    /**
     * @Route("/prova-doctrine", name="crea-utenti")
     */
    public function provaDoctrine(CasualNumberGenerator $casual_number){
        
        return $this->redirect('/users/prova-doctrine');
    }
    
}
