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
                // echo "<pre>";
                // var_dump($user); echo "</pre>";
                // echo "#########-------###############" ;
                // echo "<pre>";
                // var_dump($medecin); echo "</pre>"; exit ;
                // if this condition is not true than it means a file has uploaded , not an empty field file input .
                  if(!($_FILES['medecin']['error']['image_medecin'] == UPLOAD_ERR_NO_FILE)) {
                    // This file superglobal gets all the information from the file that we want to upload using an input from a form
                    $photo = $_FILES['medecin'];
                    // echo "<pre>" ;
                    // print_r($photo);
                    // echo "</pre>"; exit ;
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
                                /* Before we upload the file we have to make sure that when we do upload the file it gets
                                a proper name because for example a file called test.JPEG to uploads folder and someone 
                                else later on uploads a image that has the exact same name test.JPEG it will actually 
                                overwrite the existing image inside the uploads folder meaning that the other user who
                                upload an image will get his image deleted so in order to prevent that we're going to 
                                create a unique id wich gets inserted and replaced with the actual name of the file when
                                it was uploaded so instead of it being named test.JPEG coul actually get named something like 
                                bunch of numbers .JPEG */
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

            $user->setFkMedecin($medecin);
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
        echo 1 ; exit ;
        if ($this->isCsrfTokenValid('delete'.$medecin->getId(), $request->request->get('_token'))) {
            $medecinRepository->remove($medecin, true);
        }

        return $this->redirectToRoute('app_medecin_index', [], Response::HTTP_SEE_OTHER);
    }
}
