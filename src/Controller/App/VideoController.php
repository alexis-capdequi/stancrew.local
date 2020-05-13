<?php

namespace App\Controller\App;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("videos")
 */
class VideoController extends AbstractController
{
    /**
     * @Route("/", name="app_videos")
     * @return Response
     */
    public function index(VideoRepository $videoRepository): Response
    {
        return $this->render('app/videos/list.html.twig', [
            'videos' => $videoRepository->findAllOrderByIdDesc(),
        ]);
    }
    
    /**
     * @Route("/{type}", name="app_videos_bytype", requirements={"type"="previews|clips|concerts"}))
     * @return Response
     */
    public function videosByType(string $type, VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy(
            array('type' => $type),
            array('id' => 'desc')
        );
        
        return $this->render('app/videos/list.html.twig', [
            'videos' => $videos,
        ]);
    }
    
    /**
     * @Route("/watch", name="app_videos_watch")
     * @return Response
     */
    public function videoWatch(Request $request, VideoRepository $videoRepository): Response
    {
        $type = $request->get('t');
        $uniqid = $request->get('v');
        
        if (isset($type) && !empty($type)) {
            $videos = $videoRepository->findBy(
                array('type' => $type),
                array('id' => 'desc')
            );
        } else {
            $videos = $videoRepository->findAllOrderByIdDesc();
        }
        
        $video = $videoRepository->findOneBy(
            array('uniqid' => $uniqid)
        );
        
        return $this->render('app/videos/watch.html.twig', [
            'videos' => $videos,
            'video' => $video
        ]);
    }
}