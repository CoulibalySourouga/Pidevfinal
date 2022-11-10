<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin",name="home_admin")
 * @package App\Controller\admin
 */
class AdminController extends AbstractController{
    /**
     * @Route("/home",name="app_admin")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function admin(){
        return $this->render('admin/home.html.twig');
    }
}
