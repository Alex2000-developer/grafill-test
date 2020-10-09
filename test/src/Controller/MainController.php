<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;


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
     * @Route("/prova_twig/{name}", name="main")
     */
    public function prova_twig($name){
        
        return $this->render('main/prova_twig.html.twig', [
            'controller_name' => 'MainController',
            'name' => $name,
        ]);
    }
    /**
     * @Route("/stampa_ora/", name="main")
     */
    public function stampa_ora(){
        
        return $this->render('main/stampa_ora_twig.html.twig', [
            'controller_name' => 'MainController',
            'name' => 'Ciao',
        ]);
    }
    
}
