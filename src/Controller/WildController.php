<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wild", name="wild")
 */
class WildController extends AbstractController
{

    /**
     * @Route("/agenda", name="_agenda")
     */
    public function showEvents(EntityManagerInterface $em)
    {
        $events = $em->getRepository(Event::class)->findAll();
        return $this->render('wild/showEvents.html.twig', [
            'events' => $events,
        ]);
    }
}
