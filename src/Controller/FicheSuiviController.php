<?php

namespace App\Controller;

use App\Entity\FicheSuivi;
use App\Form\FicheSuiviType;
use App\Repository\FicheSuiviRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



#[Route('/fiche')]
class FicheSuiviController extends AbstractController
{
    #[Route('/', name: 'app_fiche_suivi_index', methods: ['GET'])]
    public function index(FicheSuiviRepository $ficheSuiviRepository): Response
    {
        return $this->render('fiche_suivi/index.html.twig', [
            'fiche_suivis' => $ficheSuiviRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fiche_suivi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FicheSuiviRepository $ficheSuiviRepository): Response
    {
        $ficheSuivi = new FicheSuivi();
        $form = $this->createForm(FicheSuiviType::class, $ficheSuivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheSuiviRepository->save($ficheSuivi, true);

            return $this->redirectToRoute('app_fiche_suivi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_suivi/new.html.twig', [
            'fiche_suivi' => $ficheSuivi,
            'form' => $form,
        ]);
    }

    #[Route('/{idFiche}', name: 'app_fiche_suivi_show', methods: ['GET'])]
    public function show(FicheSuivi $ficheSuivi): Response
    {
        return $this->render('fiche_suivi/show.html.twig', [
            'fiche_suivi' => $ficheSuivi,
        ]);
    }
    /**
     * @route("/recherche",name="recherche" ,methods={"GET","POST"})
     *@ParamConverter("FicheSuivi")
     *
     */


    //#[Route('/fiche/recherche',name:"recherche", methods: ['GET', 'POST'])]
    public function recherche(Request $req, EntityManagerInterface $entityManager)
    {
       // $fiche_suivis  = new FicheSuivi();
        $data = $req->get('searche');
        $repository = $entityManager->getRepository(FicheSuivi::class);
        $fiche_suivis = $repository->findBy(['diagnostic' => $data]);
        return $this->render('fiche_suivi/index.html.twig', [
            'fiche_suivis' => $fiche_suivis
        ]);
    }

    #[Route('/{idFiche}/edit', name: 'app_fiche_suivi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FicheSuivi $ficheSuivi, FicheSuiviRepository $ficheSuiviRepository): Response
    {
        $form = $this->createForm(FicheSuiviType::class, $ficheSuivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheSuiviRepository->save($ficheSuivi, true);

            return $this->redirectToRoute('app_fiche_suivi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_suivi/edit.html.twig', [
            'fiche_suivi' => $ficheSuivi,
            'form' => $form,
        ]);
    }

    #[Route('/{idFiche}', name: 'app_fiche_suivi_delete', methods: ['POST'])]
    public function delete(Request $request, FicheSuivi $ficheSuivi, FicheSuiviRepository $ficheSuiviRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheSuivi->getIdFiche(), $request->request->get('_token'))) {
            $ficheSuiviRepository->remove($ficheSuivi, true);
        }

        return $this->redirectToRoute('app_fiche_suivi_index', [], Response::HTTP_SEE_OTHER);
    }

}
