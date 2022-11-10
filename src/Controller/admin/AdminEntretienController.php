<?php

namespace App\Controller\admin;

use App\Entity\Entretien;
use App\Repository\EntretienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntretienController extends AbstractController{

    /**
     * @Route("/admimlistEntretien",name="app_adminlistentretien")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function afficherEntretien(EntretienRepository $repository){
        $entretiens = $repository->findAll();
        return $this->render('admin/entretien/list.html.twig',array("listEntretiens"=>$entretiens));

    }

    /**
     * @Route("/admindeleteEntretien/{id}",name="app_admindeleteEntretien")
     * @param Entretien $entretien
     * @param ManagerRegistry $doctrine
     * @return RedirectResponse
     */
    public function supprimerEntretien(Entretien $entretien,ManagerRegistry $doctrine):RedirectResponse
    {
        $em = $doctrine->getManager();
        $em->remove($entretien);
        $em->flush();

        return $this->redirectToRoute("app_admindeleteEntretien");
    }
}