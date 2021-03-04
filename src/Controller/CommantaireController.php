<?php

namespace App\Controller;

use App\Entity\Commantaire;
use App\Form\CommantaireType;
use App\Repository\CommantaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/new", name="commantaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commantaire = new Commantaire();
        $form = $this->createForm(CommantaireType::class, $commantaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commantaire);
            $entityManager->flush();

            return $this->redirectToRoute('commantaire_index');
        }

        return $this->render('commantaire/new.html.twig', [
            'commantaire' => $commantaire,
            'form' => $form->createView(),
        ]);
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
