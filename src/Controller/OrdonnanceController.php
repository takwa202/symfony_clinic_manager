<?php

namespace App\Controller;

use App\Entity\Ordonnance;
use App\Form\OrdonnanceType;
use App\Repository\OrdonnanceRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ordonnance')]
class OrdonnanceController extends AbstractController
{
    #[Route('/', name: 'app_ordonnance_index', methods: ['GET'])]
    public function index(OrdonnanceRepository $ordonnanceRepository): Response
    {
        return $this->render('ordonnance/index.html.twig', [
            'ordonnances' => $ordonnanceRepository->findAll(),
        ]);
    }
    #[Route('/ordpdf', name: 'app_ordonnance_pdf', methods: ['GET'])]
    public function ordpdf(OrdonnanceRepository $ordonnanceRepository): Response
    {



      $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
      //  $variab =
        // Retrieve the HTML generated in our twig file
        $html= $this->renderView('ordonnance/ordonnance.html.twig', [
            'ordonnances' => $ordonnanceRepository->findAll(),

        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Ordonnance.pdf", [
            "Attachment" => false
        ]);

    }



#[Route('/new', name: 'app_ordonnance_new', methods: ['GET', 'POST'])]
public function new(Request $request, OrdonnanceRepository $ordonnanceRepository): Response
{
    $ordonnance = new Ordonnance();
    $form = $this->createForm(OrdonnanceType::class, $ordonnance);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $ordonnanceRepository->save($ordonnance, true);
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
        $var = $ordonnance->getModeUtilisation();

        $mail->Username = 'souhaila.kharbech@esprit.tn';// SMTP username
        $mail->Password ='213JFT0516';
        $mail->setFrom('souhaila.kharbech@esprit.tn', 'Medecin');//Your application NAME and EMAIL
        $mail->Subject = ' votre Ordonnance';//Message subject
        $mail->Body = "<h1>Votre nouveau ordonnace est envoyée !</h1>{$var}";
  // Message body
       $mail->addAddress('souhaila.kharbech@esprit.tn', 'User Name');// Target email


        $mail->send();

        return $this->redirectToRoute('app_ordonnance_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('ordonnance/new.html.twig', [
        'ordonnance' => $ordonnance,
        'form' => $form,
    ]);
}

#[Route('/{idOrdonnance}', name: 'app_ordonnance_show', methods: ['GET'])]
public function show(Ordonnance $ordonnance): Response
{
    return $this->render('ordonnance/show.html.twig', [
        'ordonnance' => $ordonnance,
    ]);
}

#[Route('/{idOrdonnance}/edit', name: 'app_ordonnance_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Ordonnance $ordonnance, OrdonnanceRepository $ordonnanceRepository): Response
{
    $form = $this->createForm(OrdonnanceType::class, $ordonnance);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $ordonnanceRepository->save($ordonnance, true);

        return $this->redirectToRoute('app_ordonnance_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('ordonnance/edit.html.twig', [
        'ordonnance' => $ordonnance,
        'form' => $form,
    ]);
}
    #[Route('/{idOrdonnance}', name: 'app_ordonnance_delete', methods: ['POST'])]
    public function delete(Request $request, Ordonnance $ordonnance, OrdonnanceRepository $ordonnanceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordonnance->getIdOrdonnance(), $request->request->get('_token'))) {
            $ordonnanceRepository->remove($ordonnance, true);
        }

        return $this->redirectToRoute('app_ordonnance_index', [], Response::HTTP_SEE_OTHER);
    }
}

