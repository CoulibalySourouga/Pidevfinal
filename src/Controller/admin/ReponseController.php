<?php

namespace App\Controller\admin;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReponseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReponseController extends AbstractController{

    /**
     * @Route("/ajoutReponse/{id}",name="app_ajoutReponse")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajouterReponse(Reclamation $reclamation,Request $request,ManagerRegistry $doctrine){
        $reponse= new Reponse();
        $form=$this->createForm(ReponseType::class,$reponse);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid())
        {
           $em = $doctrine->getManager();
           $em->persist($reponse);
           $em->flush();

           return $this->redirectToRoute("app_adminlistReclamation");
        }
        return $this->render('admin/reponse/add.html.twig',array("newResponse"=>$form->createView()));
    }

    /**
     * @Route("/deleteReponse",name="app_deleteReponse")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function supprimerReponse(){
        return $this->render();
    }

    /**
     * @Route("/updateReponse",name="app_updateReponse")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function modifierReponse(){
        return $this->render();
    }

    /**
     * @Route("/listReponse",name="app_listReponse")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function afficherReponse(){
        return $this->render();
    }
}