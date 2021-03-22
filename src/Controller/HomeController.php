<?php

namespace App\Controller;


use App\Entity\Employer;
use App\Entity\Evenement;
use App\Entity\Participation;
use App\Entity\TypeEvent;
use App\Form\ParticipationType;

use App\Repository\CategoryPublicationRepository;
use App\Repository\EvenementRepository;
use phpDocumentor\Reflection\Types\This;
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
    public function participer(Request $request,$id,\Swift_Mailer $mailer)

    {

        $car = new Participation();



        $car->setDate(date('H:i:s \O\n d/m/Y'));
        $car->setIdEmployer(1);
        $car->setIdEvent($id);

        $form = $this->createForm(ParticipationType::class, $car);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $x = $em->getRepository(Participation::class)->findOneBy(array('idEvent' => $id));
        $event = $em->getRepository(Evenement::class)->find($car->getIdEvent());
        $user = $em->getRepository(Employer::class)->find($car->getIdEmployer());

        if ($form->isSubmitted() && $form->isValid() && empty($x)) {


            $em->persist($car);
            $em->flush();





            $mails = $car->getEmail();
            $message = (new \Swift_Message('nouveau participent'))
                ->setFrom($mails)
                ->setTo('firas.sougui@esprit.tn')
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'email/participation.html.twig',
                        ['participation' => $car,'event'=> $event ,'user'=>$user]
                    ),
                    'text/html'
                )

                // you can remove the following code if you don't define a text version for your emails
                ->addPart(
                    $this->renderView(
                        'email/participation.html.twig',
                        ['participation' => $car ,'event'=> $event,'user'=>$user]
                    ),
                    'text/plain'
                );

            $mailer->send($message);

            $this->addFlash('info', 'Created Successfully !');
            return $this->render('home/newpar.html.twig', ['participationForm' => $form->createView()]);


        }
        else {
            return $this->render('home/newpar.html.twig', ['participationForm' => $form->createView()]);
            //return new Response('<script>alert("Deja participé !");</script>');


        }


    }



}
