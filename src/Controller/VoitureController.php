<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Entity\Contrat;
use App\Entity\Agence;
use App\Entity\Client;
use App\Entity\Facture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/voiture")
 */
class VoitureController extends AbstractController
{
    /**
     * @Route("/", name="voiture_index", methods={"GET"})
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();
        $factures = $this->getDoctrine()->getRepository(Facture::class)->findAll();
        $contrats = $this->getDoctrine()->getRepository(Contrat::class)->findAll();
        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
            'factures'=> $factures,
            'contrats'=> $contrats,
            'clients'=>$clients,
        ]);
    }

    /**
     * @Route("/new", name="voiture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }


/** 
     * @route("/rendrevoiture/{id}",name="rendrevoiture")
     */
public function rendre (String $id , Request $request ): Response 
{
     $entityManager = $this->getDoctrine()->getManager();
    $voiture=$this->getDoctrine()->getRepository(voiture::class)->findBy($arrayName=array('id'=>$id));
     if(!$voiture) {
         throw $this->createNotFoundException('pas de voiture avec cet id '.$id);
     }
     $voiture[0]->setDisponibilite(1);
     $entityManager->flush();
     return $this->redirectToRoute('voiture_index');
}

/** 
     * @route("/louervoiture/{id}",name="louervoiture")
     */
    public function louer (String $id , Request $request ): Response 
    {
         $entityManager = $this->getDoctrine()->getManager();
        $voiture=$this->getDoctrine()->getRepository(voiture::class)->findBy($arrayName=array('id'=>$id));
         if(!$voiture) {
             throw $this->createNotFoundException('pas de voiture avec cet id'.$id);
         }
         $voiture[0]->setDisponibilite(0);
         $entityManager->flush();
         return $this->redirectToRoute('voiture_index');
    }



    /**
     * @Route("/{id}", name="voiture_show", methods={"GET"})
     */
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voiture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voiture $voiture): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voiture $voiture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voiture_index');
    }


    /**
    *@Route("/admin", name="admin")
    *@IsGranted("ROLE_ADMIN")
    */
    public function admin()
    {
        $this->denyAccesUnlessGranted('ROLE_ADMIN');
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();
         $agences = $this->getDoctrine()->getRepository(Agence::class)->findAll();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/index.html.twig',[
            'voitures' => $voitures,
            'users' => $users,
             'agences' => $agences  ]);
    }














    
}
