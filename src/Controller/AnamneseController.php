<?php

namespace App\Controller;

use App\Entity\Anamnese;
use App\Form\AnamneseType;
use App\Repository\AnamneseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/anamnese')]
class AnamneseController extends AbstractController
{
    #[Route('/', name: 'app_anamnese_index', methods: ['GET'])]
    public function index(AnamneseRepository $anamneseRepository): Response
    {
        return $this->render('anamnese/index.html.twig', [
            'anamneses' => $anamneseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_anamnese_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnamneseRepository $anamneseRepository): Response
    {
        $anamnese = new Anamnese();
        $form = $this->createForm(AnamneseType::class, $anamnese);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anamneseRepository->add($anamnese, true);

            return $this->redirectToRoute('app_anamnese_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('anamnese/new.html.twig', [
            'anamnese' => $anamnese,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_anamnese_show', methods: ['GET'])]
    public function show(Anamnese $anamnese): Response
    {
        return $this->render('anamnese/show.html.twig', [
            'anamnese' => $anamnese,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_anamnese_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Anamnese $anamnese, AnamneseRepository $anamneseRepository): Response
    {
        $form = $this->createForm(AnamneseType::class, $anamnese);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $anamneseRepository->add($anamnese, true );

            return $this->redirectToRoute('app_anamnese_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('anamnese/edit.html.twig', [
            'anamnese' => $anamnese,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_anamnese_delete', methods: ['POST'])]
    public function delete(Request $request, Anamnese $anamnese, AnamneseRepository $anamneseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anamnese->getId(), $request->request->get('_token'))) {
            $anamneseRepository->remove($anamnese, true);
        }

        return $this->redirectToRoute('app_anamnese_index', [], Response::HTTP_SEE_OTHER);
    }
}
