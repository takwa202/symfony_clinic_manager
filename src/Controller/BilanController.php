<?php

namespace App\Controller;

use App\Entity\Bilan;
use App\Form\BilanType;
use App\Repository\BilanRepository;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bilan')]
class BilanController extends AbstractController
{
    #[Route('/', name: 'app_bilan_index', methods: ['GET'])]
    public function index(BilanRepository $bilanRepository): Response
    {
        return $this->render('bilan/index.html.twig', [
            'bilans' => $bilanRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bilan_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BilanRepository $bilanRepository): Response
    {
        $bilan = new Bilan();
        $form = $this->createForm(BilanType::class, $bilan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bilanRepository->save($bilan, true);
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
            $var = $bilan->getConclusion();
            $mail->Username = 'mariem.tlili@esprit.tn';// SMTP username
            $mail->Password ='213JFT8150';
            $mail->setFrom('mariem.tlili@esprit.tn', 'Médecin');//Your application NAME and EMAIL
            $mail->Subject = 'Conclusion de votre bilan';//Message subject
            $mail->Body = "<h1>Votre nouveau bilan est ajouté cher patient! Vous pouvez consultez la conclusion de votre bilan.Pour toutes questions ou remarques,veuillez nous contacter.<p>LA CONCLUSION DE VOTRE BILAN EST:</p></h1><h2>{$var}</h2>";// Message body
            $mail->addAddress('mariem.tlili@esprit.tn', 'User Name');// Target email



            $mail->send();
            //$this->get('Session')->getFlashBag->add('bilan','Bilan ajouté avec succés!');

            return $this->redirectToRoute('app_bilan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bilan/new.html.twig', [
            'bilan' => $bilan,
            'form' => $form,
        ]);
    }

    #[Route('/{idBilan}', name: 'app_bilan_show', methods: ['GET'])]
    public function show(Bilan $bilan): Response
    {
        return $this->render('bilan/show.html.twig', [
            'bilan' => $bilan,
        ]);
    }

    #[Route('/{idBilan}/edit', name: 'app_bilan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bilan $bilan, BilanRepository $bilanRepository): Response
    {
        $form = $this->createForm(BilanType::class, $bilan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bilanRepository->save($bilan, true);

            return $this->redirectToRoute('app_bilan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bilan/edit.html.twig', [
            'bilan' => $bilan,
            'form' => $form,
        ]);
    }

    #[Route('/{idBilan}', name: 'app_bilan_delete', methods: ['POST'])]
    public function delete(Request $request, Bilan $bilan, BilanRepository $bilanRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bilan->getIdBilan(), $request->request->get('_token'))) {
            $bilanRepository->remove($bilan, true);
        }

        return $this->redirectToRoute('app_bilan_index', [], Response::HTTP_SEE_OTHER);
    }
}
