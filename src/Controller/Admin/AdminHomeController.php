<?php

namespace App\Controller\Admin;

use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminHomeController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index(ConcertRepository $concertRepository): Response
    {
        return $this->render('admin/home/index.html.twig', [
            'concerts' => $concertRepository->findAll(),
        ]);
    }
}
