<?php

namespace App\Controller;

use App\Entity\CategoryPublication;
use App\Form\CategoryPublicationType;
use App\Repository\CategoryPublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category/publication")
 */
class CategoryPublicationController extends AbstractController
{
    /**
     * @Route("/", name="category_publication_index", methods={"GET"})
     */
    public function index(CategoryPublicationRepository $categoryPublicationRepository): Response
    {
        return $this->render('category_publication/index.html.twig', [
            'category_publications' => $categoryPublicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_publication_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoryPublication = new CategoryPublication();
        $form = $this->createForm(CategoryPublicationType::class, $categoryPublication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoryPublication);
            $entityManager->flush();

            return $this->redirectToRoute('category_publication_index');
        }

        return $this->render('category_publication/new.html.twig', [
            'category_publication' => $categoryPublication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_publication_show", methods={"GET"})
     */
    public function show(CategoryPublication $categoryPublication): Response
    {
        return $this->render('category_publication/show.html.twig', [
            'category_publication' => $categoryPublication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_publication_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoryPublication $categoryPublication): Response
    {
        $form = $this->createForm(CategoryPublicationType::class, $categoryPublication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_publication_index');
        }

        return $this->render('category_publication/edit.html.twig', [
            'category_publication' => $categoryPublication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_publication_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategoryPublication $categoryPublication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryPublication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoryPublication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_publication_index');
    }
}
