<?php

namespace App\Controller\App;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("photos")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="app_pictures")
     * @return Response
     */
    public function index(PictureRepository $pictureRepository): Response
    {   
        return $this->render('app\pictures/index.html.twig', [
            'pictures' => $pictureRepository->findAllOrderByIdDesc()
        ]);
    }
}