<?php

namespace App\Controller;
use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossierRepository;


use App\Controller\UserController;
use App\Entity\Patient;
use App\Entity\User;
use App\Form\PatientType;
use App\Form\UserType;
use App\Repository\PatientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/patient')]
class PatientController extends AbstractController
{
    private $status = ['s\'épuiser' ,'en cour' ,'il a rendez-vous' , 'il a quitté' ,'il a été hospitalisé' ,'il a été défibéré' ,'il a été décédé' ,'il a été guéri' ,'il a été malade' ,'il a été malade grave'];
    #[Route('/', name: 'app_patient_index', methods: ['GET'])]
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAllPationts(),
            'status' => $this->status,

        ]);
    }

    #[Route('/new', name: 'app_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatientRepository $patientRepository , UserRepository $userRepository ,UserPasswordHasherInterface $passwordHasher): Response
    {  
        // user
        $user = new User();
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->remove('user_role');
        $formUser->handleRequest($request);
        //end user
        //start patient
        $patient = new Patient();
        
        $form = $this->createForm(PatientType::class, $patient);
        $form->remove('dossier_ass');
        $form->handleRequest($request);
        //end patient 
        $plaintextPassword = ''; // get the plain password from the form

        if ($form->isSubmitted() && $form->isValid()) {
            
            $patientRepository->add($patient, true);
            // $patient->getId();
            $user->setFkPatient($patient);
            $user->setUserRole('ROLE_PATIENT');
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            
            $user->setPassword($hashedPassword);
            $userRepository->add($user, true);
            return isset($_POST['assignee_dossier'])  ? $this->redirectToRoute('app_dossier_new', ['url'=>$patient->getId()], Response::HTTP_SEE_OTHER) : $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }
// var_dump(is_object($form));exit;

        return $this->renderForm('patient/new.html.twig', [
            'user' => $user,
            'form'=>$form,
            'formUser' => $formUser,
        ]);
    }
    #[Route('/new-dossier', name: 'app_patient_new_dossier', methods: ['GET', 'POST'])]
    public function create_dossier(Request $request, PatientRepository $patientRepository): Response
    {  
        // user
        //get patient for add dossier
        $user = new User();
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->remove('user_role');
        $formUser->handleRequest($request);
        //end user
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $patientRepository->add($patient, true);
            $patient->getId();
            
            // $user->setNom($patient->getNom());
            // $user->setPatient($patient);
            $user->setPassword($this->get('security.password_encoder')->encodePassword($user, $user->getPassword()));
            $user->setUserRole('ROLE_PATIENT');
        
 


            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }
// var_dump(is_object($form));exit;

        return $this->renderForm('patient/new.html.twig', [
            'patient' => $patient,
            'user' => $user,
            'form' => $form,
            'formUser' => $formUser,


        ]);
    }

    #[Route('/{id}', name: 'app_patient_show', methods: ['GET'])]
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patientRepository->add($patient, true);

            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_patient_delete', methods: ['POST'])]
    public function delete(Request $request, Patient $patient, PatientRepository $patientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $patientRepository->remove($patient, true);
        }
        return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
    }
}
