<?php

namespace App\Controller\admin;

use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminReclamationController extends AbstractController{

    /**
     * @Route("/admimlistReclamation",name="app_adminlistReclamation")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function afficherReclamation(ReclamationRepository $repository){
        $reclamations= $repository->findAll();
        return $this->render('admin/reclamation/list.html.twig',array("listReclamations"=>$reclamations));
    }

}