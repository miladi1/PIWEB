<?php

namespace App\Controller;

use App\Entity\Commantaire;
use App\Form\CommantaireType;
use App\Repository\CommantaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
/**
 * @Route("/commantaire")
 */
class CommantaireController extends AbstractController
{
    /**
     * @Route("/", name="commantaire_index", methods={"GET"})
     */
    public function index(CommantaireRepository $commantaireRepository): Response
    {
        return $this->render('commantaire/index.html.twig', [
            'commantaires' => $commantaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commantaire_new", methods={"POST"})
     */
    public function new()
    {
        $nom=$this->getUser()->getUsername();
        printf("//////////"+$nom);
        $commentaire = new Commantaire();



        if (isset($_POST["submit"])) {
            $commente=$_POST["commente"];
            $id_pub=$_POST["id_pub"];

            $entityManager = $this->getDoctrine()->getManager();
            $datetime = date ("Y-m-d H:i:s");
            $commentaire->setDate($datetime);
            $commentaire->setComPub($id_pub);
            $commentaire->setNom($datetime);
            $commentaire->getContenu($commente);
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('publication_indexFront');
        }

    }

    /**
     * @Route("/{id}", name="commantaire_show", methods={"GET"})
     */
    public function show(Commantaire $commantaire): Response
    {
        return $this->render('commantaire/show.html.twig', [
            'commantaire' => $commantaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commantaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commantaire $commantaire): Response
    {
        $form = $this->createForm(CommantaireType::class, $commantaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commantaire_index');
        }

        return $this->render('commantaire/edit.html.twig', [
            'commantaire' => $commantaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commantaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commantaire $commantaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commantaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commantaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commantaire_index');
    }
}
