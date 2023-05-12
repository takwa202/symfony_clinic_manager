<?php

namespace App\Controller;

use App\Entity\CommandeWeb;
use App\Form\CommandeWebType;
use App\Repository\CommandeWebRepository;
use App\services\QrCodeServices;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commande/web')]
class CommandeWebController extends AbstractController
{
    /**
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     */

    #[Route('/', name: 'app_commande_web_index', methods: ['GET'])]
    public function index(CommandeWebRepository $commandeWebRepository): Response
    {
        return $this->render('commande_web/index.html.twig', [
            'commande_webs' => $commandeWebRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commande_web_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommandeWebRepository $commandeWebRepository,MailerInterface $mailer ): Response
    {
        $qrCode=null;

        $commandeWeb = new CommandeWeb();
        $form = $this->createForm(CommandeWebType::class, $commandeWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeWebRepository->save($commandeWeb, true);


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

            $mail->Username = 'yassine.marzouki@esprit.tn';// SMTP username
            $mail->Password ='Marzouki123';
            $mail->setFrom('yassine.marzouki@esprit.tn', 'Admin Commande');//Your application NAME and EMAIL
            $mail->Subject = 'Nouvelle Commande passé';//Message subject
            $mail->Body = '<h1>Vous Avez Une Nouvelle Commande passé!<br> Destination commande: '.$commandeWeb->getDestination().'<br>
            
           </h1>';// Message body
            $mail->addAddress('yassine.marzouki@esprit.tn', 'User Name');// Target email


            $mail->send();

            return $this->redirectToRoute('app_commande_web_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_web/new.html.twig', [
            'commande_web' => $commandeWeb,
            'form' => $form,

        ]);
    }

    #[Route('/{idComd}', name: 'app_commande_web_show', methods: ['GET'])]
    public function show(CommandeWeb $commandeWeb): Response
    {
        return $this->render('commande_web/show.html.twig', [
            'commande_web' => $commandeWeb,
        ]);
    }

    #[Route('/{idComd}/edit', name: 'app_commande_web_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommandeWeb $commandeWeb, CommandeWebRepository $commandeWebRepository): Response
    {
        $form = $this->createForm(CommandeWebType::class, $commandeWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeWebRepository->save($commandeWeb, true);

            return $this->redirectToRoute('app_commande_web_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_web/edit.html.twig', [
            'commande_web' => $commandeWeb,
            'form' => $form,
        ]);
    }

    #[Route('/{idComd}', name: 'app_commande_web_delete', methods: ['POST'])]
    public function delete(Request $request, CommandeWeb $commandeWeb, CommandeWebRepository $commandeWebRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeWeb->getIdComd(), $request->request->get('_token'))) {
            $commandeWebRepository->remove($commandeWeb, true);
        }

        return $this->redirectToRoute('app_commande_web_index', [], Response::HTTP_SEE_OTHER);
    }
}
