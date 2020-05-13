<?php

namespace App\Controller\App;

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
        return $this->render('app/home/index.html.twig');
    }
}