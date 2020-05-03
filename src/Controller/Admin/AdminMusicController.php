<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Form\Admin\MusicType;
use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/music")
 */
class AdminMusicController extends AbstractController
{
    /**
     * @Route("/", name="admin_music_index", methods={"GET"})
     */
    public function index(MusicRepository $musicRepository): Response
    {
        return $this->render('admin/music/index.html.twig', [
            'musics' => $musicRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_music_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $music = new Music();
        $form = $this->createForm(MusicType::class, $music);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($music);
            $entityManager->flush();

            return $this->redirectToRoute('admin_music_index');
        }

        return $this->render('admin/music/new.html.twig', [
            'music' => $music,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_music_show", methods={"GET"})
     */
    public function show(Music $music): Response
    {
        return $this->render('admin/music/show.html.twig', [
            'music' => $music,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_music_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Music $music): Response
    {
        $form = $this->createForm(MusicType::class, $music);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_music_index');
        }

        return $this->render('admin/music/edit.html.twig', [
            'music' => $music,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_music_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Music $music): Response
    {
        if ($this->isCsrfTokenValid('delete'.$music->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($music);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_music_index');
    }
}
