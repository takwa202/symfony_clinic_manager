<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/patient')]
class PatientController extends AbstractController
{
    #[Route('/', name: 'app_patient_index', methods: ['GET'])]
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }

    #[Route('/back', name: 'app_patient_indexback', methods: ['GET'])]
    public function indexback(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/insexback.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }
    #[Route('/mainpatient', name: 'app_patient_indexmain')]
    public function mainpatient(): Response
    {
     
        return $this->render('patient/homepatient.html.twig', [
        ]);
    }
    #[Route('/home', name: 'app_patient_home', methods: ['GET'])]
    public function index2(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/homepatient.html.twig', [
        ]);
    }
    #[Route('/homewithoutlogin', name: 'app_patient_homewithoutlogin', methods: ['GET'])]
    public function index3(PatientRepository $patientRepository): Response
    {
        return $this->render('acceilwithoutlogin.html.twig', [
        ]);
    }

    #[Route('/new', name: 'app_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatientRepository $patientRepository): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
          
            $pass= $patient->getMotdepasselPatient();
            $cryptpass= md5($pass);
            $patient->setMotdepasselPatient($cryptpass);
            $patientRepository->save($patient, true);
    
            return $this->redirectToRoute('app_patient_homewithoutlogin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/{idPatient}', name: 'app_patient_show', methods: ['GET'])]
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    #[Route('/{idPatient}/edit', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRepository->save($patient, true);

            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }
    
 
    
    #[Route('/{idPatient}', name: 'app_patient_delete', methods: ['POST'])]
    public function delete(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getIdPatient(), $request->request->get('_token'))) {
            $patientRepository->remove($patient, true);
        }

        return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
    }

}
