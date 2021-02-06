<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Voiture;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Client;
use App\Entity\Agence;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;




class UserController extends AbstractController
{

    /**
     * @Route("/user", name="user")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }



 /**
     * @Route("/modifieruser/{email}", name="edituserbyemail")
     
     */
    public function modifier (Request $request, String $email): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->findBy(array('email'=> $email));
       
        if (!$user){
          throw $this->createNotFoundException(
              'pas de client avec l"email"'.$email
          );
        }
       
        $user = $user[0];
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        echo ($form->isSubmitted());
        if ($form->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('user/modifier.html.twig', ['form' => $form->createView()]);
    }



     /**
     * @Route("/supprimeruser/{email}", name="supuserbyemail")
     
     */
    public function supprimer (String $email) : Response {
        $entityManager =$this->getDoctrine()->getManager();
        $User=$this->getDoctrine()->getRepository(User::class)->findBy(array('email'=>$email));
        if (!$User){
          throw $this->createNotFoundException(
              'pas de voiture avec l"email"'.$email
          );
        }
        $entityManager->remove($User[0]);
        $entityManager->flush();
        return $this->redirectToRoute('admin');
    }

   
   
}
