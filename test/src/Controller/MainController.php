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
     * @Route("/prova_twig/{name}", name="prova_twig")
     */
    public function prova_twig($name){
        
        return $this->render('main/prova_twig.html.twig', [
            'controller_name' => 'MainController',
            'name' => $name,
        ]);
    }
    /**
     * @Route("/stampa_ora/", name="stampa_ora")
     */
    public function stampa_ora(){
        
        return $this->render('main/stampa_ora_twig.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/prova_symfony", name="prova_sympfony")
     */
    public function prova_symfony(CasualNumberGenerator $casual_number){
        
        return $this->render('main/prova_symfony_twig.html.twig', [
            'controller_name' => 'MainController',
            'casual_number' => $casual_number->getCasualNumber(),
        ]);
    }
    
}
