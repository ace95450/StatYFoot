<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Membre;
use App\Form\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CommentaireController extends AbstractController
{
    public function newCommentaire(Request $request)
    {
        // Récupération d'un membre
        $membre = $this->getDoctrine()
            ->getRepository(Membre::class)
            ->find(1);

        $commentaire = new Commentaire();

        // Déclaration d'un auteur à l'article
        $commentaire->setMembre($membre);

        // Création du formulaire
        $form =$this->createForm(CommentFormType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
        }

        # Passage à la vue du formulaire
        return $this->render('components/_comment.html.twig', [
            'form' => $form->createView()
        ]);
    }

}