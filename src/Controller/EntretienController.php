<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Form\EntretienType;
use App\Repository\EntretienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class EntretienController extends AbstractController
{
    #[Route('/entretien', name: 'app_entretien')]
    public function index(): Response
    {
        return $this->render('entretien/index.html.twig', [
            'controller_name' => 'EntretienController',
        ]);
    }

    /**
     * @Route("/ajoutEntretien",name="app_ajoutEntretien")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function ajouterEntretien(Request $request,ManagerRegistry $doctrine){
        $entretien=new Entretien();
        $form = $this->createForm(EntretienType::class,$entretien);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em = $doctrine->getManager();

            $em->persist($entretien);
            $em->flush();
            return $this->redirectToRoute("Home");
        }
        return $this->render('entretien/add.html.twig',
            array("formEntretien"=>$form->createView())
        );
    }

    /**
     * @Route("/listEntreien",name="app_listEntretien")
     * @param EntretienRepository $repository
     * @return Response
     */
    public function afficherEntretien(EntretienRepository $repository){
        $date= new \DateTime();
        $entretiens = $repository->findAll();
        return $this->render("entretien/list.html.twig", array("ListEntretiens"=>$entretiens,"dateDujour"=>$date));
    }

    /**
     * @Route("/editEntretien/{id}",name="app_editEntretien")
     * @param Entretien $entretien
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function modifierEntretien(Entretien $entretien,Request $request,ManagerRegistry $doctrine){
        $form = $this->createForm(EntretienType::class,$entretien);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute('app_listEntretien');
        }
        return $this->render('entretien/edit.html.twig',
            array("formEntretien"=>$form->createView())
        );
    }

    /**
     * @Route("/deleteEntretien/{id}",name="app_deleteEntretien")
     * @param Entretien $entretien
     * @param ManagerRegistry $doctrine
     * @return RedirectResponse
     */
    public function supprimerEntretien(Entretien $entretien,ManagerRegistry $doctrine):RedirectResponse
    {
        $em = $doctrine->getManager();
        $em->remove($entretien);
        $em->flush();

        return $this->redirectToRoute("app_listEntretien");
    }

    /**
     * @Route("/viewEntretien{id}",name="app_viewEntretien")
     * @param Entretien $entretien
     * @return Response
     */
    public function DetailsEntretien(Entretien $entretien){
        return $this->render('entretien/view.html.twig',array("entretien"=>$entretien));
    }
}
