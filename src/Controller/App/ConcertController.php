<?php

namespace App\Controller\App;

use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("concerts")
 */
class ConcertController extends AbstractController
{
    /**
     * @Route("/", name="app_concerts")
     * @return Response
     */
    public function index(ConcertRepository $concertRepository): Response
    {
        return $this->render('app/concerts/list.html.twig', [
            'concerts' => $concertRepository->findAllOrderByIdDesc(),
        ]);
    }
}