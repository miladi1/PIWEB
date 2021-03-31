<?php

namespace App\Controller;
 
use App\Entity\Employeur;
 
 
use App\Entity\opportunite;
 
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OpportuniteType;
use App\Repository\OpportuniteRepository;
 use Symfony\Component\HttpFoundation\File\UploadedFile;
 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class OpportuniteController extends AbstractController
{
    /**
     * @Route("/opportunite", name="opportunite")
     */
    public function index(): Response
    {
        return $this->render('opportunite/index.html.twig', [
            'controller_name' => 'OpportuniteController',
        ]);
    }
    /**

     * @route("/affiche",name="liste")
     */
    public function affiche(OpportuniteRepository $repository)
    {
        /*$repo=$this->getdoctrine()->getRepository(Classroom::class);*/
        $opp=$repository->findAll();

        return $this->render("home/afficheOpp.html.twig",['opp'=>$opp]);



    }
    
    
     /**
     * @param $id
     * @param OpportuniteRepository $repository
     * @Route("/d2/{id}",name="del")
     */
    function delete($id,OpportuniteRepository $repo )
    {
        $class = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($class);
        $em->flush();

        return $this->redirectToRoute('liste');
    }
    
     /**
     * @param Request $request
      
     * @Route("/ajouter",name="aff")
     */
    function Add(Request $request)
    {
        $opp=new opportunite();
        $form1=$this->createForm(OpportuniteType::class,$opp);




        $form1->handleRequest($request);


        if($form1->isSubmitted() && $form1->isValid())
        {
            $path=$this->getParameter('kernel.project_dir').'/public/assets/uploads/images';
            

$file=$opp->getLogo();
$fileName=md5(uniqid()).'.'.$file->guessExtension();

$car=$form1->getData();
$image=$car->getLogo();

$file->move($path,$fileName);
$em=$this->getDoctrine()->getManager();
 
$opp->setLogo($fileName);


            $em->persist($opp);
            $em->flush();
            return $this-> redirectToRoute('liste');

        }


        return  $this->render("home/PublierAnnonce.html.twig",[
            'form1'=>$form1->createView()]);
    }

 /**
     * @param $id
     * @param OpportuniteRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/update2/{id}",name="update")
     */
    function Update($id,OpportuniteRepository $repo, Request $request){
        $class=$repo->find($id);
        $form=$this->createForm(OpportuniteType::class,$class);


        $form->Add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('liste');
        }

        return $this->render("home/PublierAnnonce.html.twig",['form1'=>$form->createView()]);

        }

        /**
         * @Route("/search",name="recherche")
         * 
         */

     

    
  /**
    
     * @Route("/affiche/search",name="recherche")
     */
    function SearchNom(OpportuniteRepository $repos,Request $request){
        $nsc=$request->get('search');

        $opp=$repos->SearchNom($nsc);
        return $this->render("home/afficheOpp.html.twig",['opp'=>$opp]);

        return $this-> redirectToRoute('recherche');

    }
    
}
