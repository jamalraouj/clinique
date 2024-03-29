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
use App\Repository\PatientRepository ;
use App\Repository\AnamneseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/patient')]
class PatientController extends AbstractController
{
    private $status = ['s\'épuiser' ,'en cours' ,'il a rendez-vous' , 'il a quitté' ,'il a été hospitalisé' ,'il a été défibéré' ,'il a été décédé' ,'il a été guéri' ,'il a été malade' ,'il a été malade grave'];
    #[Route('/', name: 'app_patient_index', methods: ['GET'])]
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAllPatients(),
            'status' => $this->status,

        ]);
    }

    #[Route('/new', name: 'app_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatientRepository $patientRepository ,  UserRepository $userRepository ,UserPasswordHasherInterface $passwordHasher): Response
    {  
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
            $patient->setUser($user);
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
            
            'form'=>$form,
            'formUser' => $formUser,
        ]);
    }
    

    #[Route('/{id}', name: 'app_patient_show', methods: ['GET'])]
    public function show(Patient $patient): Response
    {
        // $user = $userRepository->findOneBy(['fk_patient' => $patient]);
       $statusPatient = $patient -> getStatusPatient();
       if ($statusPatient == 0) :
        $statusPatient = "s'épuiser"; $color = "brown" ;
        elseif ($statusPatient == 1):
            $statusPatient = "en cours"; $color = "lime" ;
            elseif ($statusPatient == 2) :
                $statusPatient = "il a rendez-vous" ; $color = "yellow" ;
                elseif ($statusPatient == 3) :
                    $statusPatient = "il a quitté" ; $color = "grey" ;
                    elseif ($statusPatient == 4) :
                        $statusPatient = "il a été hospitalisé" ; $color = "cyan" ;
                        elseif ($statusPatient == 5) :
                            $statusPatient = "il a été défibéré" ; $color = "pink" ;
                            elseif ($statusPatient == 6) :
                                $statusPatient = "il a été décédé" ; $color = "lightgrey" ;
                                elseif ($statusPatient == 7) :
                                    $statusPatient = "il a été guéri" ; $color = "blue" ;
                                    elseif ($statusPatient == 8) :
                                        $statusPatient = "il a été malade" ; $color = "orange" ; 
                                            else : "il a été malade grave"; $color = "red" ;
        endif;
        return $this->render('patient/show.html.twig', [
            'patient' => $patient ,
            'patientStatus' => $statusPatient,
            'StatusColor' => $color,
            'family_history' => ''
        ]);
    }

    #[Route('/{id}/edit', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient , User $user, PatientRepository $patientRepository ,UserRepository $userRepository): Response
    {
        
        
        // $formUser->handleRequest($request);

        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);
        $formUser = $this->createForm(UserType::class, $patient->getUser());
        $formUser->remove('user_role');
        $formUser->remove('password');
        $formUser->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $patientRepository->add($patient, true);
            
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('patient/edit.html.twig', [
            // 'patient' => $patient,
            'form' => $form,
            'formUser' => $formUser,
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


    #[Route("?id={id}/status={status}", name: "patient_change_status", methods: ["GET"])]
    public function change_status(Request $request, Patient $patient, PatientRepository $patientRepository  ,$id , $status): Response
    {
        if(array_key_exists($status , $this->status)){
            
            $patient->setStatusPatient($status);

            if($status == 0 ){
                $dossiers = $patient->getDossiers();
            foreach ($dossiers as $dossier) {
                $dossier->setStatusDossier(2);

            }
            }

        $patientRepository->add($patient, true , $id);
     }
        return $this->redirectToRoute('app_patient_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route("/show-dossier/{id}", name: "app_patient_dossier_show_", methods: ["GET"])]
    public function showAllDossierOfPatient(Patient $patient , UserRepository $userRepository,DossierRepository $dossierRepository , AnamneseRepository $anamneseRepository)
    { 

            $dossiers = $dossierRepository->findBy(['fk_patient' => $patient->getId()]);
            $anamneses = $anamneseRepository->findBy(['fk_patient' => $patient->getId()]);
            $user = $userRepository->findOneBy(['fk_patient' => $patient]);
            return $this->render('patient/show_dossier_of_patient.html.twig', [
                'patient' => $patient,
                'dossiers' => $dossiers,
                'anamneses' => $anamneses,
            ]);
          
    }
    #[Route("/profile/{id}", name: "app_patient_profile_", methods: ["GET"])]
    public function profile(Patient $patient ,DossierRepository $dossierRepository , AnamneseRepository $anamneseRepository)
    { 
            
            
                $dossiers = $dossierRepository->findBy(['fk_patient' => $patient->getId()]);
                $anamneses = $anamneseRepository->findBy(['fk_patient' => $patient->getId()]);
                
                return $this->render('patient/profile.html.twig', [
                    'patient' => $patient,
                    'dossiers' => $dossiers,
                    'anamneses' => $anamneses,
                ]);
             

    }
}