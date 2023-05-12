<?php

namespace App\Controller;

use App\Entity\Pharmacien;
use App\Form\PharmacienType;
use App\Repository\PharmacienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pharmacien')]
class PharmacienController extends AbstractController
///home
{
    #[Route('/', name: 'app_pharmacien_index', methods: ['GET'])]
    public function index(PharmacienRepository $pharmacienRepository): Response
    {
        return $this->render('pharmacien/index.html.twig', [
            'pharmaciens' => $pharmacienRepository->findAll(),
        ]);
    }
    #[Route('/home', name: 'app_pharmacien_indexhomefram', methods: ['GET'])]
    public function indexhomeframfromlogin(PharmacienRepository $pharmacienRepository): Response
    {
        return $this->render('pharmacien/index.html.twig', [
            'pharmaciens' => $pharmacienRepository->findAll(),
        ]);
    }
    #[Route('/tohomepharm', name: 'app_pharmacien_indextohome', methods: ['GET'])]
    public function tohome(PharmacienRepository $pharmacienRepository): Response
    {
        return $this->render('pharmacien/homephar.html.twig', [
            'pharmaciens' => $pharmacienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pharmacien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PharmacienRepository $pharmacienRepository): Response
    {
        $pharmacien = new Pharmacien();
        $form = $this->createForm(PharmacienType::class, $pharmacien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmacienRepository->save($pharmacien, true);

            return $this->redirectToRoute('app_pharmacien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharmacien/new.html.twig', [
            'pharmacien' => $pharmacien,
            'form' => $form,
        ]);
    }

    #[Route('/{idPharmacien}', name: 'app_pharmacien_show', methods: ['GET'])]
    public function show(Pharmacien $pharmacien): Response
    {
        return $this->render('pharmacien/show.html.twig', [
            'pharmacien' => $pharmacien,
        ]);
    }

    #[Route('/{idPharmacien}/edit', name: 'app_pharmacien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pharmacien $pharmacien, PharmacienRepository $pharmacienRepository): Response
    {
        $form = $this->createForm(PharmacienType::class, $pharmacien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pharmacienRepository->save($pharmacien, true);

            return $this->redirectToRoute('app_pharmacien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pharmacien/edit.html.twig', [
            'pharmacien' => $pharmacien,
            'form' => $form,
        ]);
    }

    #[Route('/{idPharmacien}', name: 'app_pharmacien_delete', methods: ['POST'])]
    public function delete(Request $request, Pharmacien $pharmacien, PharmacienRepository $pharmacienRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacien->getIdPharmacien(), $request->request->get('_token'))) {
            $pharmacienRepository->remove($pharmacien, true);
        }

        return $this->redirectToRoute('app_pharmacien_index', [], Response::HTTP_SEE_OTHER);
    }
}
