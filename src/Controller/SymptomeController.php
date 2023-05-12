<?php

namespace App\Controller;

use App\Entity\Symptome;
use App\Form\SymptomeType;
use App\Repository\SymptomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;


#[Route('/symptome')]
class SymptomeController extends AbstractController
{
    #[Route('/', name: 'app_symptome_index', methods: ['GET'])]
    public function index(SymptomeRepository $symptomeRepository): Response
    {
        return $this->render('symptome/index.html.twig', [
            'symptomes' => $symptomeRepository->findAll(),
        ]);
    }

    /**
     * @throws ConfigurationException
     * @throws TwilioException
     */
    #[Route('/new', name: 'app_symptome_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SymptomeRepository $symptomeRepository): Response
    {
        $symptome = new Symptome();
        $form = $this->createForm(SymptomeType::class, $symptome);
        $form->handleRequest($request);


        $accountSid = 'AC83b2a6dc364ae0249a72803691ce8684' ;
        $authToken = 'a594b1a438431e7aad970264b1aae079';
        $client = new Client($accountSid, $authToken);

        if ($form->isSubmitted() && $form->isValid()) {
            $symptomeRepository->save($symptome, true);
            $message = $client->messages
                ->create("+21627738774", // to
                    [
                        "body" => "Vous avez bien enregistre votre symptomes.",
                        "from" => "+16066199593",
                        "statusCallback" => "http://postb.in/1234abcd"
                    ]
                );

            print($message->sid);
            return $this->redirectToRoute('app_symptome_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('symptome/new.html.twig', [
            'symptome' => $symptome,
            'form' => $form,
        ]);
    }

    #[Route('/{idSym}', name: 'app_symptome_show', methods: ['GET'])]
    public function show(Symptome $symptome): Response
    {
        return $this->render('symptome/show.html.twig', [
            'symptome' => $symptome,
        ]);
    }

    #[Route('/{idSym}/edit', name: 'app_symptome_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Symptome $symptome, SymptomeRepository $symptomeRepository): Response
    {
        $form = $this->createForm(SymptomeType::class, $symptome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symptomeRepository->save($symptome, true);

            return $this->redirectToRoute('app_symptome_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('symptome/edit.html.twig', [
            'symptome' => $symptome,
            'form' => $form,
        ]);
    }

    #[Route('/{idSym}', name: 'app_symptome_delete', methods: ['POST'])]
    public function delete(Request $request, Symptome $symptome, SymptomeRepository $symptomeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $symptome->getIdSym(), $request->request->get('_token'))) {
            $symptomeRepository->remove($symptome, true);
        }

        return $this->redirectToRoute('app_symptome_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/maladie/{idSym}', name: 'maladie')]
    public function maladie(SymptomeRepository $repo, $idSym)
    {
        $symptome = $repo->find($idSym);
        $maladie = "Consultez votre medecin";

        if (($symptome->getFievre() == 1) && ($symptome->getFatigue() == 1) && ($symptome->getDouleurMusculaire() == 1) && ($symptome->getEcoulementNasal() == 1) && ($symptome->getMalDeTete() == 1) && ($symptome->getToux() == 0) && ($symptome->getMalDeGorge() == 0) && ($symptome->getEssouflement() == 0) && ($symptome->getPerteDAppetit() == 0) && ($symptome->getNausee() == 0) && ($symptome->getVomissement() == 0) && ($symptome->getAutre() == "")) {
            $maladie = "Vous avez la grippe ";
        } else if (($symptome->getToux() == 1) && ($symptome->getFievre() == 1) && ($symptome->getFatigue() == 1) && ($symptome->getDouleurMusculaire() == 0) && ($symptome->getMalDeGorge() == 0) && ($symptome->getEssouflement() == 0) && ($symptome->getPerteDAppetit() == 0) && ($symptome->getEcoulementNasal() == 0) && ($symptome->getNausee() == 0) && ($symptome->getVomissement() == 0) && ($symptome->getMalDeTete() == 0) && ($symptome->getAutre() == "")) {
            $maladie = "Vous avez la bronchite ";
        } else if (($symptome->getFievre() == 1) && ($symptome->getDouleurMusculaire() == 1) && ($symptome->getMalDeGorge() == 1) && ($symptome->getPerteDAppetit() == 1) && ($symptome->getToux() == 0) && ($symptome->getFatigue() == 0) && ($symptome->getEssouflement() == 0) && ($symptome->getEcoulementNasal() == 0) && ($symptome->getNausee() == 0) && ($symptome->getVomissement() == 0) && ($symptome->getMalDeTete() == 0) && ($symptome->getAutre() == "")) {
            $maladie = "Vous avez l'angine ";
        } else if (($symptome->getFievre() == 1) && ($symptome->getNausee() == 1) && ($symptome->getVomissement() == 1) && ($symptome->getAutre() == "diarrhee") && ($symptome->getToux() == 0) && ($symptome->getFatigue() == 0) && ($symptome->getDouleurMusculaire() == 0) && ($symptome->getMalDeGorge() == 0) && ($symptome->getEssouflement() == 0) && ($symptome->getPerteDAppetit() == 0) && ($symptome->getEcoulementNasal() == 0) && ($symptome->getMalDeTete() == 0)) {
            $maladie = "Vous avez une infection intestinale ";
        } else if (($symptome->getToux() == 1) && ($symptome->getFievre() == 1) && ($symptome->getFatigue() == 1) && ($symptome->getDouleurMusculaire() == 1) && ($symptome->getEssouflement() == 1) && ($symptome->getMalDeTete() == 1) && ($symptome->getMalDeGorge() == 0) && ($symptome->getPerteDAppetit() == 0) && ($symptome->getEcoulementNasal() == 0) && ($symptome->getNausee() == 0) && ($symptome->getVomissement() == 0) && ($symptome->getAutre() == "")) {
            $maladie = "Vous avez la corona virus  ";
        } else {
            $maladie = "Consulter votre medecin ";
        }

        return $this->renderForm('symptome/maladie.html.twig', [
            'maladie' => $maladie
        ]);
    }













}
