<?php

namespace App\Controller;

use App\Entity\TypeEvent;
use App\Form\TypeEventType;
use App\Repository\TypeEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/event")
 */
class TypeEventController extends AbstractController
{
    /**
     * @Route("/", name="type_event_index", methods={"GET"})
     */
    public function index(TypeEventRepository $typeEventRepository): Response
    {
        return $this->render('type_event/index.html.twig', [
            'type_events' => $typeEventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeEvent = new TypeEvent();
        $form = $this->createForm(TypeEventType::class, $typeEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeEvent);
            $entityManager->flush();

            return $this->redirectToRoute('type_event_index');
        }

        return $this->render('type_event/new.html.twig', [
            'type_event' => $typeEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_event_show", methods={"GET"})
     */
    public function show(TypeEvent $typeEvent): Response
    {
        return $this->render('type_event/show.html.twig', [
            'type_event' => $typeEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeEvent $typeEvent): Response
    {
        $form = $this->createForm(TypeEventType::class, $typeEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_event_index');
        }

        return $this->render('type_event/edit.html.twig', [
            'type_event' => $typeEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeEvent $typeEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_event_index');
    }
}
