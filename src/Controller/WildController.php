<?php

namespace App\Controller;

use App\Entity\Act;
use App\Entity\Event;
use App\Form\ContactType;
use App\Form\GameFormType;
use App\Service\CasinoGame;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showContact(Request $request, Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();
            $from = $this->getParameter('mailer_from');
            $to = $contactData['email'];
            $view = 'wild/emailContact.html.twig';
            $subjectContact = $this->getParameter('subject_contact_email');
            try {
                $mailer->sendContactEmail($from, $to, $contactData, $subjectContact, $view);
                $this->addFlash('success', 'Votre email a bien été envoyé !');
                return $this->redirectToRoute('wild_contact');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue, votre email n\'a pas été envoyé');
                return $this->redirectToRoute('wild_contact');
            }
        }


        return $this->render('wild/contact.html.twig', [
            'form' => $form->createview()
        ]);
    }

    /**
     * @Route("/game", name="_game", methods={"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayGame(Request $request): Response
    {
        $form = $this->createForm(GameFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameData = $form->getData();
        }

        return $this->render('wild/game.html.twig', [
            'form' => $form->createview()
        ]);
    }

    /**
     * @Route("/play")
     * @param CasinoGame $casinoGame
     * @param Request $request
     * @return JsonResponse
     */
    public function playGame(CasinoGame $casinoGame, Request $request)
    {
        $choicesFromClient = json_decode(
            $request->getContent(),
            true
        );


        $gameIssue = $casinoGame->playGame($choicesFromClient);

        return new JsonResponse([
            'gameIssue' => $gameIssue,
        ], 200);
    }
}
