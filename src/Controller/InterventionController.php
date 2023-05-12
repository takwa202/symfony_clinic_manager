<?php

namespace App\Controller;

use App\Entity\Intervention;
use App\Form\InterventionType;
use App\Repository\CalendertableRepository;
use App\Repository\InterventionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/intervention')]
class InterventionController extends AbstractController
{
    #[Route('/', name: 'app_maininter')]
    public function index(InterventionRepository $calendar): Response
    {
        $events=  $calendar->findAll();
        foreach($events as $ev){
           $inter[]=[
            'id'=>$ev->getIdInterv(),
            'descriptions'=>$ev->getDescriptions(),
            'start'=>$ev->getStart()->format('Y-m-d H:i:s'),
            'end'=>$ev->getEnd()->format('Y-m-d H:i:s'),
           'backgroundColor'=>$ev->getBackgroundcolor(),
            'borderColor'=>$ev->getBordercolor(),
            'textColor'=>$ev->getTextcolor(),


           ]; 
        }
        
      
        $data = json_encode($inter);
        return $this->render('intervention/index.html.twig', compact('data'));
    }
    

    #[Route('/new', name: 'app_intervention_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InterventionRepository $interventionRepository): Response
    {
        $intervention = new Intervention();
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $interventionRepository->save($intervention, true);

            return $this->redirectToRoute('app_maininter', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervention/new.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);
    }

    #[Route('/{idInterv}', name: 'app_intervention_show', methods: ['GET'])]
    public function show(Intervention $intervention): Response
    {
        return $this->render('intervention/show.html.twig', [
            'intervention' => $intervention,
        ]);
    }

    #[Route('/{idInterv}/edit', name: 'app_intervention_edit', methods: ['GET'])]
    public function edit(Request $request, Intervention $intervention, InterventionRepository $interventionRepository): Response
    {
        dd($request);
       /* $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $interventionRepository->save($intervention, true);

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervention/edit.html.twig', [
            'intervention' => $intervention,
            'form' => $form,
        ]);*/
    }

    #[Route('/{idInterv}', name: 'app_intervention_delete', methods: ['POST'])]
    public function delete(Request $request, Intervention $intervention, InterventionRepository $interventionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$intervention->getIdInterv(), $request->request->get('_token'))) {
            $interventionRepository->remove($intervention, true);
        }

        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
    }
}
