<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('acceilwithoutlogin.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
  
   
    #[Route('/main/logout', name: 'app_mainlogout')]
    public function logout(): Response
    {
        return $this->render('acceilwithoutlogin.html.twig', [
           
        ]);
    }
    
    #[Route('/main/signein', name: 'app_mainlogout2')]
    public function signein(): Response
    {
        return $this->render('main/signeinaswhat.html.twig', [
           
        ]);
    }
    #[Route('/homeadmin', name: 'app_mainhomeadmin')]
    public function indexback(): Response
    {
        return $this->render('main/homeadmin.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
