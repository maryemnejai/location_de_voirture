<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Voiture;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Agence;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/admin", name="admin")
     */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
    *@Route("/admin", name="admin")
    *@IsGranted("ROLE_ADMIN")
    */
    public function admin()
    {
        denyAccessUnlessGranted('ROLE_ADMIN');
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/index.html.twig',['voiture' => $voitures,'users' => $users]);
    }


    
    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function userListe(UserRepository $user){
        return $this->render("admin/user.html.twig",[
            'users'=>$user->findAll()
        ]);

    }


}
