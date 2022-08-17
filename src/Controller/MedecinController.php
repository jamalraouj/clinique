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
        $medecinData = $medecinRepository->findAllDoctors();
        return $this->render('medecin/test.html.twig', [
            'medecins' => $medecinData 
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

                // Setting the value null by default for the medecin Image
                $medecin -> setImageMedecin(null);
                // if this condition is not true than it means a file has uploaded , not an empty field file input .
                  if(!($_FILES['medecin']['error']['image_medecin'] == UPLOAD_ERR_NO_FILE)) {
                    // This file superglobal gets all the information from the file that we want to upload using an input from a form
                    $photo = $_FILES['medecin'];
                    // $_files array contains  : name/ type / tmp_name / error / size
                    $fileName = $photo['name']['image_medecin'];
                    $fileTmpName = $photo['tmp_name']['image_medecin'];
                    $fileSize = $photo['size']['image_medecin'];
                    $fileError = $photo['error']['image_medecin'];
                
                    // to get the extension of the file
                    $fileExt = explode('.', $fileName);
                    // Make sure that always the extension comes in small letters
                    $fileActualExt = strtolower(end($fileExt));
                
                    // inside this array we gonna tell it wich type of files we want to allow inside the website
                    $allowed = array('jpg' , 'jpeg' , 'png' , 'webp');
                
                    if(in_array($fileActualExt , $allowed)) {
                        // if the file error is equal to 0 that means that we had no erros uploading this file 
                        if($fileError == 0){
                
                            if($fileSize < 5000000){

                                $fileNameNew = "doctor".uniqid().".". $fileActualExt;
                                $fileDestination = $medecin-> UPLOAD_FOLDER  . "/medecin/" . $fileNameNew ;
                                move_uploaded_file($fileTmpName,$fileDestination);
                                $medecin->setImageMedecin($fileNameNew);
        
                            } else {
                                echo "Your file is too big !";
                                exit ;
                            }
                
                            } else {
                            echo "There was an error uploading your file !";
                            exit ;
                            }
                
                    } else {
                        echo "You can not upload files of this type !";
                        exit ;
                    }
                }              
            // Making Sure that the matricule is UpperCase
            strtoupper($medecin->getMatricule());    
            // Adding the medecin to the database
            $medecinRepository->add($medecin, true);

            $user -> setFkMedecin($medecin);
            strtoupper($user -> getCin());
            $user -> setUserRole('ROLE_MEDECIN');
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            
            $user->setPassword($hashedPassword);
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/new.html.twig', [
            'form' => $formUser ,
            'medecinForm' => $formMedecin
        ]);
    }

    #[Route('/{id}', name: 'app_medecin_show', methods: ['GET'])]
    public function show(int $id,Medecin $medecin , UserRepository $userRepository): Response
    {
        // Giving the id to the function to get doctor data
        $doctorData = $userRepository -> getDoctorDetaById($id) ;
        // var_dump($doctorData); exit ;   
        // $array_doctor_data = [
        //     'nom' => $doctorData[0] ,
        //     'prenom' => $doctorData[1] ,
        //     'age' => $doctorData[2] ,
        //     'address' => $doctorData[3] ,
        //     'telephone' => $doctorData[4] ,
        // ];
        return $this->render('medecin/show.html.twig', [
            'medecin' => $medecin,
            'medecinUsData' => $doctorData[0]
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medecin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id , Medecin $medecin, User $user, MedecinRepository $medecinRepository): Response
    {
        $formMedecin = $this->createForm(MedecinType::class, $medecin);
        $formMedecin->handleRequest($request);

        $formUser = $this->createForm(UserType::class, $user);
        $formUser->remove('user_role');
        $formUser->handleRequest($request);

        if ($formMedecin->isSubmitted() && $formMedecin->isValid()) {
            $medecinRepository->add($medecin, true);


            return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medecin/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $formUser,
            'medecinForm' => $formMedecin
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
