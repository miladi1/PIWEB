<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Entity\Participation;
use App\Form\ParticipationType;
use App\Repository\CategoryPublicationRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $evenementRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {

        return $this->render('base2.html.twig');
    }
    /**
     * @Route("/post-job", name="post")
     */
    public function postjobaction()
    {
        return $this->render('home/post-job.html.twig');
    }
        /**
         * @Route("/participer/{id}", name="participer")
         */


    public function participer(Request $request,$id)
    {

        $car = new Participation();
        $car->setDate(date('H:i:s \O\n d/m/Y'));
        $car->setIdEmployer(1);
        $car->setIdEvent($id);
        $form = $this->createForm(ParticipationType::class, $car);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();
        $this->addFlash('info', 'Created Successfully !');
        return $this->redirectToRoute('evenement_index');
    }
}
