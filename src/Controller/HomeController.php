<?php

namespace App\Controller;


use App\Entity\Employer;
use App\Entity\Evenement;
use App\Entity\Participation;
use App\Entity\TypeEvent;
use App\Form\ParticipationType;

use App\Repository\CategoryPublicationRepository;
use App\Repository\EmployerRepository;
use App\Repository\EvenementRepository;
use App\Repository\OpportuniteRepository;
use App\Repository\ParticipationRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EvenementRepository $evenementRepository,OpportuniteRepository $repository): Response
    {
        $opp=$repository->findAll();

        return $this->render('home/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),'can'=>$opp
        ]);
    }
    /**
     * @Route("/event", name="event")
     */
    public function index2(EvenementRepository $evenementRepository): Response
    {


        return $this->render('home/index2.html.twig', [
            'evenements' => $evenementRepository->findAll()]);
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
    public function postjobaction(ParticipationRepository $participationRepository ,EmployerRepository $employerRepository,EvenementRepository $repository)
    {

        $car = $participationRepository->findAll();
        $car2 = $repository->findAll();
        $car3 = $employerRepository->findAll();


        return $this->render('home/post-job.html.twig',['participation'=>$car,'events'=>$car2,'employes'=>$car3]);
    }

    /**
     * @Route("/post-job/{id}", name="participation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Participation $participation,ParticipationRepository $pr): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $event = $entityManager->getRepository(Evenement::class)->find($participation->getIdEvent());
            $event->setNombrePar($event->getNombrePar()+1);
            $entityManager->remove($participation);
            $entityManager->persist($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/participer/{id}", name="participer")
     */
    public function participer(Request $request,$id,\Swift_Mailer $mailer,ParticipationRepository $pr)

    {

        $car = new Participation();

        $car->setDate(date('H:i:s \O\n d/m/Y'));
        $car->setIdEmployer($this->getUser()->getId());
        $car->setIdEvent($id);
        $car->setEmail($this->getUser()->getUsername());

        $form = $this->createForm(ParticipationType::class, $car);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $event =null;

        $x = $pr->findOneBySomeField($this->getUser()->getId(),$id);
        $event = $em->getRepository(Evenement::class)->find($car->getIdEvent());
        $userr = $em->getRepository(Employer::class)->find($car->getIdEmployer());
        $event->setNombrePar($event->getNombrePar()-1);
        if ($form->isSubmitted() && $form->isValid()) {

            if (empty($x)) {

                $em->persist($car,$event);
                $em->flush();


                $mails = $car->getEmail();
                $message = (new \Swift_Message('nouveau participent'))
                    ->setFrom($mails)
                    ->setTo('firas.sougui@esprit.tn')
                    ->setBody(
                        $this->renderView(
                        // templates/emails/registration.html.twig
                            'email/participation.html.twig',
                            ['participation' => $car, 'event' => $event, 'userr' => $userr]
                        ),
                        'text/html'
                    )

                    // you can remove the following code if you don't define a text version for your emails
                    ->addPart(
                        $this->renderView(
                            'email/participation.html.twig',
                            ['participation' => $car, 'event' => $event, 'userr' => $userr]
                        ),
                        'text/plain'
                    );

                $mailer->send($message);

                $this->addFlash('info', 'Created Successfully !');
                return $this->redirectToRoute('home', ['participationForm' => $form->createView()]);
            } else {
                return new Response('<script>alert("Deja participé !");window.location.replace("http://localhost:8000");</script>');
            }
        }
        return $this->render('home/newpar.html.twig', ['participationForm' => $form->createView()]);


        //return new Response('<script>alert("Deja participé !");</script>');


    }
    /**
     * @Route("/participe/{id}", name="participe")
     */
    public function getparticiper(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $x = $em->getRepository(Participation::class)->findOneBy(array('idEvent' => $id));
        if (empty($x)) {
            return false;
        }
        else
            return true;

    }




}
