<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Entity\Specialite;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use App\Repository\SpecialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
#[Route('/dossier')]
class DossierController extends AbstractController
{
    private $status = ['En cours','En attente','Terminé','Annulé'];
    #[Route('/', name: 'app_dossier_index', methods: ['GET'])]
    public function index(DossierRepository $dossierRepository): Response
    {
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossierRepository->findAll(),
            'status' =>  $this->status,
        ]);
    }

    #[Route('/new', name: 'app_dossier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DossierRepository $dossierRepository , SpecialiteRepository $specialiteRepository): Response
    {
        
        // $specialites = $specialiteRepository->findAll();
        // var_dump($specialites[1]->getNom());exit;
        $dossier = new Dossier();
         
        $form = $this->createForm(DossierType::class, $dossier);
        // $form->fk_specialite = $specialites;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossier->setDateMaintenant(new \DateTime());
            $dossierRepository->add($dossier, true , $_GET['url']);// url is id of patient

            return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/show{id}', name: 'app_dossier_show', methods: ['GET'])]
    public function show(Dossier $dossier): Response
    {
        return $this->render('dossier/show.html.twig', [
            'dossier' => $dossier,

        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dossier $dossier, DossierRepository $dossierRepository): Response
    {
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dossierRepository->add($dossier, true , $_GET['url']);

            return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_delete', methods: ['POST'])]
    public function delete(Request $request, Dossier $dossier, DossierRepository $dossierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $dossierRepository->remove($dossier, true);
        }

        return $this->redirectToRoute('app_dossier_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/{status}', name: 'dossier_change_status', methods: ['GET'])]
    public function changeStatus(Dossier $dossier, DossierRepository $dossierRepository , Request $request, $status , $id)
    {
    
        $dossier->setStatusDossier($status);
        $dossierRepository->add($dossier, true , $id);
        //get last route
        $url = $request->headers->get('referer');
        return $this->redirect($url);
        // return $this->redirectToRoute('route', [], Response::HTTP_SEE_OTHER);

    }

}
