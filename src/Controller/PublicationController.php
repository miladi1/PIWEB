<?php

namespace App\Controller;

use App\Entity\Commantaire;
use App\Entity\Publication;
use App\Form\PublicationType;
use App\Repository\CommantaireRepository;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
/**
 * @Route("/publication")
 */
class PublicationController extends AbstractController
{
    /**
     * @Route("/", name="publication_index", methods={"GET"})
     */
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('publication/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/list", name="publication_pdf", methods={"GET"})
     */
    public function pdf(PublicationRepository $publicationRepository): Response
    {


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $publication = $publicationRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('publication/Listepdfpub.html.twig', [
            'publications' => $publication ,
        ]);
// Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Listepdfpub.pdf", [
            "Attachment" => true
        ]);

    }

    /**
     * @Route("/PublicationFront", name="publication_indexFront", methods={"GET"})
     */
    public function indexFront(PublicationRepository $publicationRepository ,CommantaireRepository $commantaireRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Publication::class)->findAll();

        $publications = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos publications)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 ); // Nombre de résultats par page
        return $this->render('Publication/indexFront.html.twig', [
            'publications' => $publications,'commantaires' => $commantaireRepository->findAll(),
        ]);



    }

    /**
     * @Route("/new", name="publication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $publication = new Publication(new \DateTime('today'));
        $publication->setTitre($this->getUser()->getName());
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);
        $file = $publication->getImg();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($file != null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $publication->setImg($fileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $publication->setImg($fileName);
            $datetime = date("Y-m-d H:i:s");
            $publication->setDate($datetime);
            $publication->setLikes(0);
            $publication->setVus(0);
            $publication->setNombreCom(0);
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('publication_index');
        }

        return $this->render('publication/new.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publication_show", methods={"GET"})
     */
    public function show(Publication $publication): Response
    {
        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="publication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Publication $publication): Response
    {

        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publication_index');
        }

        return $this->render('publication/edit.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="publication_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Publication $publication): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('publication_index');
    }

    /**
     * @Route("/rechercheFront", name="publication_rechercheFront")
     */
    public function rechercheFront(Request $request, PublicationRepository $publicationRepository)
    {
        $data = $request->get('data');
        $publication = $publicationRepository->rech($data);
        return $this->render('Publication/indexFront.html.twig', [
            'publications' => $publication,
            /*$allPublicationQuery*/
            /*
                        'publications' => $publicationRepository->findBy(array('Titre' => $data)),*/
        ]);
    }

    /**
     * @Route("/commantaire_new", name="commantaire_new", methods={"POST"})
     */
    public function new_commente()
    {
        $commentaire = new Commantaire();


        if (isset($_POST["submit"])) {
            $commente=$_POST["commente"];
            $id_pub=$_POST["id_pub"];
            $entityManager = $this->getDoctrine()->getManager();
            $datetime = date ("Y-m-d H:i:s");
            $commentaire->setDate($datetime);
            $commentaire->setComPub($id_pub);
            $commentaire->setNom($this->getUser()->getName());
            $commentaire->setContenu($commente);
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('publication_indexFront');
        }

    }



    /**
     * @Route("/recherche", name="publication_recherche")
     */
    public function recherche(Request $request, PublicationRepository $publicationRepository)
    {
        $data = $request->get('data');
        $publication = $publicationRepository->rech($data);
        return $this->render('Publication/index.html.twig', [
            'publications' => $publication,
            /*$allPublicationQuery*/
            /*
                        'publications' => $publicationRepository->findBy(array('Titre' => $data)),*/
        ]);
    }

    /**
     * @Route("/triH", name="tri")
     */
    public function Tri(Request $request, PublicationRepository $repository): Response
    {
        // Retrieve the entity manager of Doctrine
        $order = $request->get('type');
        if ($order == "Croissant") {
            $publications = $repository->tri_asc();
        } else {

            $publications = $repository->tri_desc();
        }
        // Render the twig view
        return $this->render('publication/index.html.twig', ['publications' => $publications
        ]);
    }


}
