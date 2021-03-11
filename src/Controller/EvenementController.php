<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EvenementSearch;
use App\Entity\TypeEvent;
use App\Form\EvenementSearchType;
use App\Form\Evenement1Type;
use App\Repository\EvenementRepository;
use App\Repository\TypeEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index")
     */
   public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement(new \DateTime('today'),new \DateTime('today'));

        $form = $this->createForm(Evenement1Type::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(Evenement1Type::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evenement_index');
    }

    /**
     * @Route("/t/pdf", name="pdf")
     */
    public function pdfAction()
    {
        $em= $this->getDoctrine()->getManager();
        $pro =$em->getRepository(Evenement::class)->findAll();
        $cat =$em->getRepository(TypeEvent::class)->findAll();
        $date = date("Y:m:d");


        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView(
            '@evenement/pdf.html.twig',
            array(
                'events'=> $pro,'typeevent'=>$cat
            ));

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    /**
     * @Route("/t/pdf2", name="pdf1")
     */
    public function pdf()
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(TypeEvent::class)->findAll();
        $pro = $em->getRepository(Evenement::class)->findAll();

        return $this->render('evenement/pdf.html.twig', array(
            'events' => $pro,'typeevent' => $cat
        ));
    }
    /**
     * @Route("/event/ajax_search", name="ajax_search" ,methods={"GET"})
     * @param Request $request
     * @param EvenementRepository $evenementRepository
     * @return Response
     */
    public function searchAction(Request $request,EvenementRepository $evenementRepository) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $evenements =$evenementRepository->SearchNom($requestString);
        if(!$evenements) {
            $result['evenements']['error'] = "evenement non trouvée ";
        } else {
            $result['evenements'] = $this->getRealEntities($evenements);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($evenements){
        foreach ($evenements as $evenement){
            $realEntities[$evenement->getId()] = [$evenement->getTitre(),$evenement->getDateStart(),$evenement->getDateEnd()];

        }
        return $realEntities;
    }

}
