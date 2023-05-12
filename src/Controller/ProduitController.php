<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ContactType;
use App\Form\ProduitType;
use App\Entity\PriceSearch;
use App\Form\PriceSearchType;
use App\Repository\ProduitRepository;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ProduitController extends AbstractController
{
    #[Route('/prod', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/trier",name="tricat")
     */
    function trier (ProduitRepository $repo ){
        $produits=$repo->ordrebycategories();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits
        ]);

    }


    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository, MailerInterface $mailer, SluggerInterface $slugger): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


          $photo = $form->get('photo')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('Produit_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $produit->setImage($newFilename);
            }

            $produitRepository->save($produit, true);
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

            $mail->Username = 'mohamedkhames.mhadhbi@esprit.tn';// SMTP username
            $mail->Password ='213JMT1233';
            $mail->setFrom('mohamedkhames.mhadhbi@esprit.tn', 'Admin Evènements');//Your application NAME and EMAIL
            $mail->Subject = 'Nouveau Produit';//Message subject
            $mail->Body = '<h1>Vous Avez Un Nouveau Produit a ajouter:<br> Nom Evènement: </h1>';// Message body
            $mail->addAddress('mohamedkhames.mhadhbi@esprit.tn', 'User Name');// Target email


            $mail->send();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{idProd}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @route("/recherche",name="recherche")
     */

    public function recherche(Request $req, EntityManagerInterface $entityManager)
    {
        $data = $req->get('searche');
        $repository = $entityManager->getRepository(Produit::class);
        $produits = $repository->findBy(['nomProd' => $data]);
        return $this->render('produit/index.html.twig', [
            'produits' => $produits
        ]);
    }


    #[Route('/{idProd}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }



    #[Route('/{idProd}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdProd(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route ("/contact", name="app_contact",methods={"GET","POST"})
     */
    public function contact(Request $request): Response
    {

        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('produit/contact.html.twig', [

            'form'=>$form
        ]);
    }


    /*#[Route('/r/search_rec', name: 'search_rec', methods: ['GET'])]
    public function search_rec(Request $request,NormalizerInterface $Normalizer,ProduitRepository $produitRepository ): Response
    {

        $requestString = $request->get('searchValue');
        $requestString2 = $request->get('searchValue2');
        $requestString3 = $request->get('orderid');

        dump($requestString);
        dump($requestString2);
        $produits = $produitRepository->findProduitsBySujet($requestString, $requestString2, $requestString3);
        dump($produits);
        $jsoncontentc = $Normalizer->normalize($produits, 'json', ['groups' => 'posts:read']);
        dump($jsoncontentc);
        $jsonc = json_encode($jsoncontentc);
        //  dump($jsonc);
        if ($jsonc == "[]") {
            return new Response(null);
        } else {

            return new Response($jsonc);
        }

    }*/

    /**
     * @Route("/art_prix/", name="produit_par_prix")
     * Method({"GET"})
     */
    /*public function produitsParPrix(Request $request)
    {

        $priceSearch = new PriceSearch();
        $form = $this->createForm(PriceSearchType::class,$priceSearch);
        $form->handleRequest($request);

        $produits= [];

        if($form->isSubmitted() && $form->isValid()) {
            $minPrice = $priceSearch->getMinPrice();
            $maxPrice = $priceSearch->getMaxPrice();

            $produits= $this->getDoctrine()->getRepository(Article::class)->findByPriceRange($minPrice,$maxPrice);
        }

        return  $this->render('produit/ProduitparPrix.html.twig',[ 'form' =>$form->createView(), 'produits' => $produits]);
    }*/

}
