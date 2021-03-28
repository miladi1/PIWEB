<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [


            'controller_name' => 'HomeController',
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
    public function postjobaction(){
        return $this->render('home/post-job.html.twig');

    }
}
