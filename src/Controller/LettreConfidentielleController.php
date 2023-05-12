<?php

namespace App\Controller;

use App\Entity\LettreConfidentielle;
use App\Form\LettreConfidentielleType;
use App\Repository\LettreConfidentielleRepository;
use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lettre/confidentielle')]
class LettreConfidentielleController extends AbstractController
{
    #[Route('/', name: 'app_lettre_confidentielle_index', methods: ['GET'])]
    public function index(LettreConfidentielleRepository $lettreConfidentielleRepository): Response
    {
        return $this->render('lettre_confidentielle/index.html.twig', [
            'lettre_confidentielles' => $lettreConfidentielleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lettre_confidentielle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LettreConfidentielleRepository $lettreConfidentielleRepository): Response
    {
        $lettreConfidentielle = new LettreConfidentielle();
        //$lettreConfidentielle->setDate(new \DateTime('now'));
        $form = $this->createForm(LettreConfidentielleType::class, $lettreConfidentielle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lettreConfidentielleRepository->save($lettreConfidentielle, true);

            return $this->redirectToRoute('app_lettre_confidentielle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lettre_confidentielle/new.html.twig', [
            'lettre_confidentielle' => $lettreConfidentielle,
            'form' => $form,
        ]);
    }
    #[Route('/pdf/{idconf}', name: 'lettre.pdf', methods: ['GET'])]
    public function generatepdflettre(LettreConfidentielle $lettreConfidentielle = null ,PdfService $pdf)
    {

        return $this->render('lettre_confidentielle/show.html.twig', [
            'lettre_confidentielle' => $lettreConfidentielle]);
        $pdf->showPdfFile($html);
    }



    #[Route('/{idconf}', name: 'app_lettre_confidentielle_show', methods: ['GET'])]
    public function show(LettreConfidentielle $lettreConfidentielle): Response
    {
        return $this->render('lettre_confidentielle/show.html.twig', [
            'lettre_confidentielle' => $lettreConfidentielle,
        ]);
    }

    #[Route('/{idconf}/edit', name: 'app_lettre_confidentielle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LettreConfidentielle $lettreConfidentielle, LettreConfidentielleRepository $lettreConfidentielleRepository): Response
    {
        $form = $this->createForm(LettreConfidentielleType::class, $lettreConfidentielle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lettreConfidentielleRepository->save($lettreConfidentielle, true);

            return $this->redirectToRoute('app_lettre_confidentielle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lettre_confidentielle/edit.html.twig', [
            'lettre_confidentielle' => $lettreConfidentielle,
            'form' => $form,
        ]);
    }

    #[Route('/{idconf}', name: 'app_lettre_confidentielle_delete', methods: ['POST'])]
    public function delete(Request $request, LettreConfidentielle $lettreConfidentielle, LettreConfidentielleRepository $lettreConfidentielleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lettreConfidentielle->getIdconf(), $request->request->get('_token'))) {
            $lettreConfidentielleRepository->remove($lettreConfidentielle, true);
        }

        return $this->redirectToRoute('app_lettre_confidentielle_index', [], Response::HTTP_SEE_OTHER);
    }




}
