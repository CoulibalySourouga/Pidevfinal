<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ReclamationController extends AbstractController
{
    /**
     *
     * @return Response
     */
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig.', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    /**
     * @Route("/ajoutReclamation",name="app_ajoutReclamation")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function ajouterReclamation(Request $request, ManagerRegistry $doctrine)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute("Home");
        }
        return $this->render('reclamation/add.html.twig', array("formReclamation" => $form->createView()));
    }

    /**
     * @Route("/listReclamations",name="app_listReclamations")
     * @param ReclamationRepository $repository
     * @return Response
     */
    public function afficherReclamation(ReclamationRepository $repository)
    {
        $date = new \DateTime();
        $reclamations = $repository->findAll();
        return $this->render('reclamation/list.html.twig', array("ListReclamations" => $reclamations,"dateDujour"=>$date));
    }

    /**
     * @Route("/deleteReclamation{id}",name="app_deleteReclamation")
     * @param Reclamation $reclamation
     * @param ManagerRegistry $doctrine
     * @return RedirectResponse
     */
    public function supprimerReclamation(Reclamation $reclamation,ManagerRegistry $doctrine){

        $em= $doctrine->getManager();
        $em->remove($reclamation);
        $em->flush();

        return $this->redirectToRoute('app_listReclamations');
    }

    /**
     * @Route("/updateReclamation/{id}",name="appp_updateReclamation")
     * @param Reclamation $reclamation
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function modifierReclamation(Reclamation $reclamation,Request $request,ManagerRegistry $doctrine){
        $form= $this->createForm(ReclamationType::class,$reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isSubmitted()){
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_listReclamations');
        }
        return $this->render('reclamation/edit.html.twig',array("formReclamation"=>$form->createView()));
    }

    /**
     * @Route("/viewReclamation{id}",name="app_viewReclamation")
     * @param Reclamation $reclamation
     * @return Response
     */
    public function DetailsReclamation(Reclamation $reclamation){
        return $this->render('reclamation/view.html.twig',array("reclamation"=>$reclamation));
    }
}
