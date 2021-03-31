<?php

namespace App\Controller;
 
use App\Entity\Candidature;
use App\Entity\Mailing;
use App\Entity\decisionCandidature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CandidatureType;
use App\Form\DecisionCandidatureType;
use App\Form\MailingType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MailingRepository;
use App\Repository\CandidatureRepository;
use App\Repository\DecisionCandidatureRepository;
use App\Repository\OpportuniteRepository;
 use Symfony\Component\HttpFoundation\File\UploadedFile;
 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 

class MailingController extends AbstractController
{


    /**
     * @Route("/maili", name="a")
     */
    public function index(): Response
    {
        return $this->render('mailing/index.html.twig', [
            'controller_name' => 'MailingController',
        ]);
    }
 
     /**
     

     * @route("/envoie/{id}",name="envoie")
     */
   
        
        public function z($id,CandidatureRepository $rep,Request $request)
        {
           
            $data=$request->get('id');
            $id=$rep->findBy(['id'=>$data]);
             
            $o=new Mailing();
        
            

            $form1=$this->createForm(MailingType::class,$o);
    
    
            $form1->handleRequest($request);
    
            

            if($form1->isSubmitted() && $form1->isValid())
            {
                    
    $o->setRef($data);
    $em=$this->getDoctrine()->getManager();
      
                $em->persist($o);
                $em->flush();
                
                return $this->redirectToRoute('verif',['id' => $data]);
            }
             
    
            return  $this->render("home/send_mail.html.twig",[ 
                'form1'=>$form1->createView(),'candi'=>$id]);
          
    
     


 

    }
      /**
     * @param $id
     * @param OpportuniteRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/updateMail/{id}",name="updateMail")
     */
    function Update($id,MailingRepository $repo, Request $request){
        $class=$repo->find($id);
        $form=$this->createForm(MailingType::class,$class);


        $form->Add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('mailing');
        }

        return $this->render("home/ModifStatut.html.twig",['form1'=>$form->createView()]);

        }
     /**
   * @route("/admin/statistique",name="sta")
     */
    public function statisti(MailingRepository $repository)
    {
         
        $opp=$repository->findAll();

        return $this->render("home/statistique.html.twig",['cand'=>$opp]);

    }
  /**

     * @route("/etat/{id}",name="rech")
     */
    
    
    public function a ($id,MailingRepository $rep,Request $request)
    {
        
        $data=$request->get('id');

        $opp=$rep->findBy(['ref'=>$data]);
 
        
    return $this->render("home/etat.html.twig",['candi'=>$opp]);


}
    
    /**

     * @route("/mail/{id}",name="mail")
     */
    
    function indiq($id,Request $request,CandidatureRepository $repository)
    {
        $data=$request->get('id');
        $id=$repository->findBy(['id'=>$data]);

         
        
        
         

        return  $this->render("home/send_mail.html.twig",['candi'=>$id]);
    }
    /**

     * @route("/Resultat/{id}",name="verif")
     */
    
    function VerifMail($id,Request $request,CandidatureRepository $repository)
    {
        $data=$request->get('id');
        $opp=$repository->findBy(['id'=>$data]);

         

         

        return  $this->render("home/afficheRe.html.twig",['candi'=>$opp]);
    }
   
 /**
    
     * @Route("/etat/{id}/search",name="recherc")
     */
    function SearchNom($id,MailingRepository $repos,Request $request){
        $id=$request->get('id');

 
        $nsc=$request->get('Rechercher');

        $opp=$repos->SearchNom($nsc);
        return $this->render("home/etat.html.twig",['candi'=>$opp,'id'=>$id]);

        return $this-> redirectToRoute('recherc');

    }
    /**

     * @route("/Status",name="mailing")
     */
    public function affiche(MailingRepository $repository)
    {
        /*$repo=$this->getdoctrine()->getRepository(Classroom::class);*/
        $opp=$repository->findAll();

        return $this->render("home/gestionMailing.html.twig",['opp'=>$opp]);



    }
      


 
}
