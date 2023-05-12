<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Mailer\MailerInterface;

use Symfony\Component\Routing\Annotation\Route;


#[Route('/medecin')]
class MedecinController extends AbstractController
{
    #[Route('/', name: 'app_medecin_index', methods: ['GET'])]
    public function index(MedecinRepository $medecinRepository): Response
    {
        return $this->render('medecin/index.html.twig', [
            'medecins' => $medecinRepository->findAll(),
        ]);
    }

    #[Route('/2', name: 'app_medecin_index2', methods: ['GET'])]
    public function index2(MedecinRepository $medecinRepository): Response
    {
        return $this->render('medecin/show_bfront.html.twig', [
            'medecins' => $medecinRepository->findAll(),
        ]);
    }
    #[Route('/home', name: 'app_medecin_index3', methods: ['GET'])]
    public function home(MedecinRepository $medecinRepository): Response
    {
        return $this->render('acceilmed.html.twig', [
             'controller_name' => 'MainController',
        ]);
    }
    #[Route('/homemed', name: 'app_medecin_indextohome', methods: ['GET'])]
    public function tohome(MedecinRepository $medecinRepository): Response
    {
        return $this->render('medecin/medhome.html.twig', [
             'controller_name' => 'MainController',
        ]);
    }

    #[Route('/new', name: 'app_medecin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MedecinRepository $medecinRepository,MailerInterface $mailer): Response
    {
        $medecin = new Medecin();
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medecinRepository->save($medecin, true);
           

            return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/new.html.twig', [
            'medecin' => $medecin,
            'form' => $form,
        ]);
    }

    #[Route('/{idMed}', name: 'app_medecin_show', methods: ['GET'])]
    public function show(Medecin $medecin): Response
    {
        return $this->render('medecin/show.html.twig', [
            'medecin' => $medecin,
        ]);
    }

    #[Route('/{idMed}/edit', name: 'app_medecin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medecin $medecin, MedecinRepository $medecinRepository): Response
    {
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medecinRepository->save($medecin, true);

            return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $form,
        ]);
    }

   
    #[Route('/{idMed}/block', name: 'app_medecin_block', methods: ['GET', 'POST'])]
    public function block(Request $request, Medecin $medecin, MedecinRepository $medecinRepository): Response
    {   
 
       $medecin->setIsBlocked(1);
        if ($this->isCsrfTokenValid('bloc'.$medecin->getIdMed(), $request->request->get('_token'))) {
            $medecinRepository->save($medecin, true);
            
            $alldata = $medecinRepository->findAll();
            $row= $alldata;
       
      
            if($alldata){
                foreach($alldata as $data){
                
                    $med= new Medecin();
                    $med=$data;
                    $rec=$med->getNbRecMed();
                    if($rec>10){
                        $med->setIsBlocked(1);
                        $medecinRepository->save($medecin,true);
                    }
                    if($rec>5 && $rec<10){
                   
                        $mail = new PHPMailer(true);

                        $mail->isSMTP();// Set mailer to use SMTP
                        $mail->CharSet = "utf-8";// set charset to utf8
                        $mail->SMTPAuth = true;// Enable SMTP authentication
                        $mail->SMTPSecure = 'tls';// Enable TLS encryption, ssl also accepted
                        
                        $mail->Host = 'smtp.gmail.com';// Specify main and backup SMTP servers
                        $mail->Port = 587;// TCP port to connect to
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->isHTML(true);// Set email format to HTML
                        
                        $mail->Username = 'tabibiapp8@gmail.com';// SMTP username
                        $mail->Password ='oouqsueogwkcphyn';
                        $mail->setFrom('tabibiapp8@gmail.com', 'Admin Evènements');//Your application NAME and EMAIL
                        $mail->Subject = 'ALERT !';//Message subject
                        $mail->Body = '<h1>Vous Avez plus que 5 reclamation <br> </h1>';// Message body
                        $mail->addAddress('takwa.lassoued@esprit.tn');// Target email

                        $mail->send();
                     

                    }
                }
    
            }
    
        }

        return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
    }

   

    #[Route('/{idMed}/unblock', name: 'app_medecin_unblock', methods: ['GET', 'POST'])]
    public function unblock(Request $request, Medecin $medecin, MedecinRepository $medecinRepository): Response
    {   
 
       $medecin->setIsBlocked(0);
        if ($this->isCsrfTokenValid('bloc'.$medecin->getIdMed(), $request->request->get('_token'))) {
            $medecinRepository->save($medecin, true);
            
        
    
            }
    
        

        return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
    }
   


    #[Route('/{idMed}', name: 'app_medecin_delete', methods: ['POST'])]

    public function delete(Request $request, Medecin $medecin, MedecinRepository $medecinRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medecin->getIdMed(), $request->request->get('_token'))) {
            $medecinRepository->remove($medecin, true);
        }

        return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
    }
}
