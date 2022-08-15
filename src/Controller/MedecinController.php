<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\User;
use App\Form\MedecinType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\MedecinRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/medecin')]
class MedecinController extends AbstractController
{
    #[Route('/', name: 'app_medecin_index', methods: ['GET'])]
    public function index(MedecinRepository $medecinRepository): Response
    {
    //    ["0" => "Inactive" , "1" => "Active" , "2" => "Malade" , "3" => "En Congé"] 
        $medecinData = $medecinRepository->findAll();
        return $this->render('medecin/test.html.twig', [
            'medecins' => $medecinData ,
        ]);
    }

    #[Route('/new', name: 'app_medecin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MedecinRepository $medecinRepository , UserRepository $userRepository , UserPasswordHasherInterface $passwordHasher): Response
    {
        // Creating The User Form will be created From the class UserType Generator Form To link the Medecin Data to the User Entity Related With The Foreign Key
        $user = new User();
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->remove('user_role');
        $formUser->handleRequest($request);
        // Creating The Medecin Form will be created From the class MedecinType Generator Form 
        $medecin = new Medecin();
        $formMedecin = $this->createForm(MedecinType::class, $medecin);
        $formMedecin->handleRequest($request);

        $plaintextPassword = ''; // get the plain password from the form

        if ($formMedecin->isSubmitted() && $formMedecin->isValid()) {
            $medecinRepository->add($medecin, true);

            $user->setFkMedecin($medecin->getId());
            $user->setUserRole('ROLE_MEDECIN');
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            
            $user->setPassword($hashedPassword);
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/new.html.twig', [
            'medecin' => $medecin,
            'form' => $formUser ,
            'medecinForm' => $formMedecin
        ]);
    }

    #[Route('/{id}', name: 'app_medecin_show', methods: ['GET'])]
    public function show(Medecin $medecin): Response
    {
        return $this->render('medecin/show.html.twig', [
            'medecin' => $medecin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medecin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medecin $medecin, MedecinRepository $medecinRepository): Response
    {
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medecinRepository->add($medecin, true);

            return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_medecin_delete', methods: ['POST'])]
    public function delete(Request $request, Medecin $medecin, MedecinRepository $medecinRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medecin->getId(), $request->request->get('_token'))) {
            $medecinRepository->remove($medecin, true);
        }

        return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
    }
}
