<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Membre;
use App\Form\CommentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CommentaireController extends AbstractController
{
    /**
     * Formulaire pour commenter
     * @Route("/comment", name="Commentaire_new")
     * @param Request $request
     * @return Response
     */
    public function newCommentaire(Request $request)
    {
        // Récupération d'un membre
        $membre = $this->getUser();

        $commentaire = new Commentaire();
        $commentaire->setMembre($membre->getPseudo());
        // Création du formulaire
        $form = $this->createForm(CommentFormType::class, $commentaire, [
            'action' => $this->generateUrl('Commentaire_new'),
            'method' => 'POST',
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            return $this->json(['result' => true]);
        }

        # Passage à la vue du formulaire
        return $this->render('components/_comment.html.twig', [
            'form' => $form->createView()
        ]);
    }
}