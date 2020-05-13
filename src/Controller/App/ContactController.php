<?php

namespace App\Controller\App;

use App\Entity\Message;
use App\Form\App\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="app_contact", methods={"GET","POST"})
     * @return Response
     */
    public function index(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
        }

        return $this->render('app/contact/index.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }
}