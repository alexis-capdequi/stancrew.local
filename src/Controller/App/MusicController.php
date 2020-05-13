<?php

namespace App\Controller\App;

use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("musiques")
 */
class MusicController extends AbstractController
{
    /**
     * @Route("/", name="app_musics")
     * @return Response
     */
    public function index(MusicRepository $musicRepository): Response
    {
        return $this->render('app\musics/player.html.twig', [
            'musics' => $musicRepository->findAllOrderByIdDesc(),
        ]);
    }
}