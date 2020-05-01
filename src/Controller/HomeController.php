<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{   
    /**
     * @Route("/", name="app_home")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
}