<?php

namespace App\Controller;

use App\Entity\Act;
use App\Entity\Event;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wild", name="wild")
 */
class WildController extends AbstractController
{

    /**
     * @Route("/agenda", name="_agenda")
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEvents(EntityManagerInterface $em)
    {
        $events = $em->getRepository(Event::class)->findAll();
        return $this->render('wild/showEvents.html.twig', [
            'events' => $events,
        ]);
    }

    /**
     * @Route("/programme", name="_programme")
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showActs(EntityManagerInterface $em)
    {
        $acts = $em->getRepository(Act::class)->findAll();
        return $this->render('wild/showActs.html.twig', [
            'acts' => $acts,
        ]);
    }

    /**
     * @Route("/contact", name="_contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showContact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();
        }


        return $this->render('wild/contact.html.twig', [
            'form' => $form->createview()
        ]);
    }
}
