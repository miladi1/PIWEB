<?php

namespace App\Controller;
 
use App\Entity\Candidature;
 
use App\Entity\decisionCandidature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CandidatureType;
use App\Form\DecisionCandidatureType;

use App\Repository\CandidatureRepository;
use App\Repository\DecisionCandidatureRepository;
use App\Repository\OpportuniteRepository;
 use Symfony\Component\HttpFoundation\File\UploadedFile;
 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CandidatureController extends AbstractController
{


    /**
     * @Route("/candidature", name="candidature")
     */
    public function index(): Response
    {
        return $this->render('candidature/index.html.twig', [
            'controller_name' => 'CandidatureController',
        ]);
    }
    /**
     

     * @route("/afficheCa",name="listeC")
     */
    public function affiche(CandidatureRepository $repository)
    {
        /*$repo=$this->getdoctrine()->getRepository(Classroom::class);*/
        $opp=$repository->findAll();

        return $this->render("home/afficheCandidature.html.twig",['cand'=>$opp]);

      


    }
     /**
     

     * @route("/afficheCan/{id}",name="listeEmp")
     */
   
        
        public function afficheEmp($id,CandidatureRepository $rep,Request $request)
        {
            
            $data=$request->get('id');
    
            $opp=$rep->findBy(['titre'=>$data]);

 
        return $this->render("home/afficheOppEmp.html.twig",['candi'=>$opp]);


 

    }
    /**
   * @route("/afficheCD",name="listeD")
     */
    public function affich(CandidatureRepository $repository)
    {
         
        $opp=$repository->findAll();

        return $this->render("home/afficheCandidature.html.twig",['cand'=>$opp]);

    }
     /**
   * @route("/admin/statistique",name="sta")
     */
    public function statisti(CandidatureRepository $repository)
    {
         
        $opp=$repository->findAll();

        return $this->render("home/statistique.html.twig",['cand'=>$opp]);

    }
   
  
     /**
     * @param $id
     * @param CandidatureRepository $repository
     * @Route("/del/{id}",name="delete")
     */
    function delete($id,CandidatureRepository $repo )
    {
        $class = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($class);
        $em->flush();

        return $this->redirectToRoute('listeC');
    }
    
     /**
     * @param Request $request
      
     * @Route("/ajoutC",name="condidature")
     */
    function Add(Request $request)
    {
        $opp=new Candidature();
        $form1=$this->createForm(CandidatureType::class,$opp);


        $form1->handleRequest($request);


        if($form1->isSubmitted() && $form1->isValid())
        {
                

$em=$this->getDoctrine()->getManager();
  


            $em->persist($opp);
            $em->flush();
            
            return $this-> redirectToRoute('listeC');

        }


        return  $this->render("home/PublierCandidature.html.twig",[
            'form1'=>$form1->createView()]);
    }

 /**
     * @param $id
     * @param CandidatureRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/update/{id}",name="updat")
     */
    function Update($id,CandidatureRepository $repo, Request $request){
        $class=$repo->find($id);
        $form=$this->createForm(CandidatureType::class,$class);


        $form->Add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listeC');
        }

        return $this->render("home/PublierCandidature.html.twig",['form1'=>$form->createView()]);

        }

}
