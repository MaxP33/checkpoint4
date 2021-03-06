<?php

namespace App\Controller;

use App\Entity\Act;
use App\Form\ActType;
use App\Repository\ActRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/act")
 */
class ActController extends AbstractController
{
    /**
     * @Route("", name="act_index", methods={"GET"})
     * @param ActRepository $actRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(ActRepository $actRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $acts = $paginator->paginate($actRepository->findAll(), $request->query->getInt('page', 1), 3);
        return $this->render('act/index.html.twig', [
            'acts' => $acts,
        ]);
    }

    /**
     * @Route("/new", name="act_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $act = new Act();
        $form = $this->createForm(ActType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($act);
            $entityManager->flush();

            return $this->redirectToRoute('act_index');
        }

        return $this->render('act/new.html.twig', [
            'act' => $act,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="act_show", methods={"GET"})
     */
    public function show(Act $act): Response
    {
        return $this->render('act/show.html.twig', [
            'act' => $act,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="act_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Act $act): Response
    {
        $form = $this->createForm(ActType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('act_index');
        }

        return $this->render('act/edit.html.twig', [
            'act' => $act,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="act_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Act $act): Response
    {
        if ($this->isCsrfTokenValid('delete'.$act->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($act);
            $entityManager->flush();
        }

        return $this->redirectToRoute('act_index');
    }
}
