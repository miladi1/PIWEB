<?php

namespace App\Controller;

use App\Entity\Employeur;
use App\Form\EmployeurType;
use App\Repository\EmployerRepository;
use App\Repository\EmployeurRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
        $employeur->setNotif(0);
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


            return $this->redirectToRoute('app_log');
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

    /**
     * @Route("/find", name="employeur_f")
     */
    public function find(Request $request, EmployeurRepository $employeurRepository)
    {
        $data=$request->get('data');
        $employeur=$employeurRepository->fin($data);
        return $this->render('employeur/fin.html.twig', [
            'employeurs' =>  $employeur,  /*$allEmployeurQuery*/

            /* 'employers' => $employerRepository->findBy(array('nom' => $data)),*/
        ]);
    }

    /**
     * @Route("/add/{id}", name="employeur_add")
     */
    public function add(EmployeurRepository $employeurRepository,$id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $employeur = $entityManager->getRepository(Employeur::class)->find($id);
        $employeur->setNotif($employeur->getNotif()+1);
        $entityManager->persist($employeur);
        $entityManager->flush();
        return $this->render('employeur/fin.html.twig', [
            'employeurs' => $employeurRepository->findAll(),
        ]);
    }
    /**
     * @Route("/list/pdf", name="employeur_pdf", methods={"GET"})
     */
    public function pdf(EmployeurRepository $employeurRepository): Response
    {



        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $employeur = $employeurRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('employeur/listepdf.html.twig', [
            'employeurs' => $employeur,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("listepdf.pdf", [
            "Attachment" => true
        ]);

    }

    /**
     * @Route("/{id}/update", name="employeur_update", methods={"GET","POST"})
     */
    public function update(Request $request, Employeur $employeur, UserPasswordEncoderInterface $encoder): Response
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
            $hash = $encoder->encodePassword($employeur, $employeur->getPass());
            $employeur->setPass($hash);
            $this->getDoctrine()->getManager()->flush();
            $employeur->setLogo($fileName);

            return $this->redirectToRoute('employeur_profile');
        }

        return $this->render('employeur/update.html.twig', [
            'employeur' => $employeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/employeur/profil", name="employeur_profile", methods={"GET"})
     */
    public function profile(EmployeurRepository $employeurRepository): Response
    {

        return $this->render('employeur/profile.html.twig', [
            'employeurs' => $employeurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="employeur_supp", methods={"supp"})
     */
    public function supp(Request $request, Employeur $employeur,TokenStorageInterface $tokenStorage): Response
    {
        if ($this->isCsrfTokenValid('supp' . $employeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employeur);
            $entityManager->flush();
            $tokenStorage->setToken(null);
            $this->get('session')->invalidate();
        }

        return $this->redirectToRoute('home');
    }


}
