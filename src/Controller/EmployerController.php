<?php

namespace App\Controller;

use App\Entity\Employer;

use App\Form\EmployerType;
use App\Repository\EmployerRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/employer")
 */
class EmployerController extends AbstractController
{
    /**
     * @Route("/", name="employer_index", methods={"GET"})
     */
    public function index(EmployerRepository $employerRepository): Response
    {

        return $this->render('employer/index.html.twig', [
            'employers' => $employerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/profile", name="employer_profile", methods={"GET"})
     */
    public function profile(EmployerRepository $employerRepository): Response
    {

        return $this->render('employer/profile.html.twig', [
            'employers' => $employerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/list", name="employer_pdf", methods={"GET"})
     */
    public function pdf(EmployerRepository $employerRepository): Response
    {



        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $employer = $employerRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('employer/listepdf.html.twig', [
            'employers' => $employer,
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
     * @Route("/login", name="employer_login")
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsename = $utils->getLastUsername();
        return $this->render('employer/login.html.twig',[
            'error'          => $error,
            'lastUsername'   => $lastUsename
        ]);
    }

    /**
     * @Route("/new", name="employer_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $employer = new Employer();
        $form = $this->createForm(EmployerType::class, $employer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $employer->getImg();
            if ($file != null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'),$fileName);
                $employer->setImg($fileName);

            }
            $hash = $encoder->encodePassword($employer, $employer->getMdp());
            $employer->setMdp($hash);
            $entityManager = $this->getDoctrine()->getManager();
            $employer->setImg($fileName);
            $entityManager->persist($employer);
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('employer/new.html.twig', [
            'employer' => $employer,
            'form' => $form->createView(),

        ]);

    }

    /**
     * @Route("/{id}", name="employer_show", methods={"GET"})
     */
    public function show(Employer $employer): Response
    {
        return $this->render('employer/show.html.twig', [
            'employer' => $employer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employer $employer, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(EmployerType::class, $employer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $employer->getImg();
            if ($file != null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'),$fileName);
                $employer->setImg($fileName);

            }
            $hash = $encoder->encodePassword($employer, $employer->getMdp());
            $employer->setMdp($hash);
            $employer->setImg($fileName);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->
            add('info', 'Validation Faite .....');

            return $this->redirectToRoute('employer_index');
        }


        return $this->render('employer/edit.html.twig', [
            'employer' => $employer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employer $employer): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employer_index');
    }

    /**
     * @Route("/mailling/employer", name="Envoyer_Mail")
     */
    public function sendEmail(EmployerRepository $employerRepository,\Swift_Mailer $mailer): Response
    {
        $message = (new \Swift_Message('VERFICATION'))
            ->setFrom('masseoudi.amine99@gmail.com')
            ->setTo('masseoudi.amine99@gmail.com')
            ->setBody("Valider Votre Compte")
        ;
        $mailer->send($message) ;

        return $this->render('employer/index.html.twig', [
            'employers' => $employerRepository->findAll(),
        ]);
    }
    /**
     * @Route("/search", name="employer_r")
     */
    public function recherche(Request $request, EmployerRepository $employerRepository)
    {
        $data=$request->get('data');
        $employer=$employerRepository->reche($data);
        return $this->render('Employer/index.html.twig', [
            'employers' =>  $employer,  /*$allEmployeurQuery*/

            /* 'employers' => $employerRepository->findBy(array('nom' => $data)),*/
        ]);
    }
    /**
     * @Route("/triH", name="trih")
     */
    public function Tri(Request $request,EmployerRepository $repository): Response
    {
        // Retrieve the entity manager of Doctrine
        $order=$request->get('type');
        if($order== "Croissant"){
            $employers = $repository->tri_asc();
        }
        else {
            $employers = $repository->tri_desc();
        }
        // Render the twig view
        return $this->render('employer/index.html.twig', [
            'employers' => $employers
        ]);
    }

    /**
     * @Route("/{id}/edite", name="employer_update", methods={"GET","POST"})
     */
    public function update(Request $request, Employer $employer , UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(EmployerType::class, $employer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $employer->getImg();
            if ($file != null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'),$fileName);
                $employer->setImg($fileName);

            }
            $hash = $encoder->encodePassword($employer, $employer->getMdp());
            $employer->setMdp($hash);
            $employer->setImg($fileName);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->
            add('info', 'Validation Faite .....');

            return $this->redirectToRoute('employer_profile');
        }


        return $this->render('employer/update.html.twig', [
            'employer' => $employer,
            'form' => $form->createView(),
        ]);
    }

}