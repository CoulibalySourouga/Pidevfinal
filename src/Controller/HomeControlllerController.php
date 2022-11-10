<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeControlllerController extends AbstractController
{
    /**
     * @Route("/",name="Home")
     * @return Response
     */
   public function home(){
       $date = new \DateTime();
       return $this->render('index.html.twig',array("dateDuJour"=>$date));
   }
}
