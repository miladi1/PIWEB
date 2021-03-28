<?php

namespace App\Controller;

use App\Entity\Employeur;
use App\Form\EmployeurType;
use App\Repository\EmployeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/employeur")
 */
class EmployeurController extends AbstractController
{
    /**
     * @Route("/", name="employeur_index", methods={"GET"})
     */
    public function index(EmployeurRepository $employeurRepository): Response
    {
        return $this->render('employeur/index.html.twig', [
            'employeurs' => $employeurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="employeur_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $employeur = new Employeur();
        $form = $this->createForm(EmployeurType::class, $employeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $employeur->getLogo();
            if ($file != null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $employeur->setLogo($fileName);

            }

            $hash = $encoder->encodePassword($employeur, $employeur->getPass());
            $employeur->setPass($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $employeur->setLogo($fileName);
            $entityManager->persist($employeur);
            $entityManager->flush();


            return $this->redirectToRoute('employeur_index');
        }

        return $this->render('employeur/new.html.twig', [
            'employeur' => $employeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employeur_show", methods={"GET"})
     */
    public function show(Employeur $employeur): Response
    {
        return $this->render('employeur/show.html.twig', [
            'employeur' => $employeur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employeur $employeur): Response
    {
        $form = $this->createForm(EmployeurType::class, $employeur);
        $form->handleRequest($request);
        $file = $employeur->getLogo();
        if ($form->isSubmitted() && $form->isValid()) {

            if ($file != null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $employeur->setLogo($fileName);

            }
            $this->getDoctrine()->getManager()->flush();
            $employeur->setLogo($fileName);

            return $this->redirectToRoute('employeur_index');
        }

        return $this->render('employeur/edit.html.twig', [
            'employeur' => $employeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employeur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employeur $employeur): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employeur_index');
    }

    /**
     * @Route("/recherche", name="employeur_recherche")
     */
    public function recherche(Request $request, EmployeurRepository $employeurRepository)
    {
        $data = $request->get('data');
        $employeur = $employeurRepository->rech($data);
        return $this->render('Employeur/index.html.twig', [
            'employeurs' => $employeur,  /*$allEmployeurQuery*/

            /* 'employeurs' => $employeurRepository->findBy(array('nom' => $data)),*/
        ]);
    }

    /**
     * @Route("/triH", name="tri")
     */
    public function Tri(Request $request, EmployeurRepository $repository): Response
    {
        // Retrieve the entity manager of Doctrine
        $order = $request->get('type');
        if ($order == "Croissant") {
            $employeurs = $repository->tri_asc();
        } else {
            $employeurs = $repository->tri_desc();
        }
        // Render the twig view
        return $this->render('employeur/index.html.twig', [
            'employeurs' => $employeurs
        ]);
    }
}
