<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
 
use Symfony\Component\HttpFoundation\Request;

class SmsController extends AbstractController
{
    /**
     * @Route("/sms", name="sms")
     */
    public function index(Request $req)
    {
        
        return $this->render('sms/index.html.twig', [
            'controller_name' => 'SmsController',
        ]);
    }
     

}
