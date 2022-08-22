<?php

namespace App\Controller;

use App\Entity\Lit;
use App\Form\LitType;
use App\Repository\LitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lit')]
class LitController extends AbstractController
{
    #[Route('/', name: 'app_lit_index', methods: ['GET'])]
    public function index(LitRepository $litRepository): Response
    {
        return $this->render('lit/index.html.twig', [
            'lits' => $litRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LitRepository $litRepository): Response
    {
        $lit = new Lit();
        $form = $this->createForm(LitType::class, $lit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $litRepository->add($lit, true);

            return $this->redirectToRoute('app_lit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lit/new.html.twig', [
            'lit' => $lit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lit_show', methods: ['GET'])]
    public function show(Lit $lit): Response
    {
        return $this->render('lit/show.html.twig', [
            'lit' => $lit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lit $lit, LitRepository $litRepository): Response
    {
        $form = $this->createForm(LitType::class, $lit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $litRepository->add($lit, true);

            return $this->redirectToRoute('app_lit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lit/edit.html.twig', [
            'lit' => $lit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lit_delete', methods: ['POST'])]
    public function delete(Request $request, Lit $lit, LitRepository $litRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lit->getId(), $request->request->get('_token'))) {
            $litRepository->remove($lit, true);
        }

        return $this->redirectToRoute('app_lit_index', [], Response::HTTP_SEE_OTHER);
    }
}
