<?php

namespace App\Controller;

use App\Entity\Calendertable;

use App\Entity\Intervention;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApicalController extends AbstractController
{
    #[Route('/apical', name: 'app_apical')]
    public function index(): Response
    {
        return $this->render('intevention/index.html.twig', [
            'controller_name' => 'ApicalController',
        ]);
    }

    
  
    #[Route('/apical/{id}/edit', name: 'api_event_edit', methods: ['GET','PUT','POST'])]

 
    public function majEvent(?Intervention $calondar ,Request $req):Response
    {
       
        dd($req);
          /*
        $foo = array();
      $var=$req->attributes->all();
      foreach($var as $key =>$value ){
        array_push($foo,$value);
      }
      $var3= $foo[7];
     
      // dd(gettype($var3));
        $data =$var3;
        
       $hh =$data->getTitle();
       // dd($hh);
     //  $entityManager = $doctrine->getManager();
     //  $product = $entityManager->getRepository(Product::class)->find($id);
       if(
           
        $data !=null

        ){
         $code=200;
         if (!$calondar){
            $calondar=new Calendertable;
        $code=201;
         }
         

         $calondar->setTitle($data->getTitle());
         $calondar->setStart($data->getstart());
         $calondar->setEnd($data->getEnd());
         $calondar->setDescription($data->getDescription());
         $calondar->setBacgroundcouleur($data->getBacgroundcouleur());
         $calondar->setBordercouleur($data->getBordercouleur());
         $calondar->setTextcouleur($data->getTextcouleur());
       //  dd($calondar);
         //$entityManager = $doctrine->getManager();
      // $entityManager->persist($calondar);
     // $entityManager->flush();
       return new Response('sucsess',404);

        }else{
            return new Response('donnees incompletes',404);
        }


     return $this->render('intervention/index.html.twig', [
            'controller_name' => 'ApicalController',
        ]);
        */
    } 
}

