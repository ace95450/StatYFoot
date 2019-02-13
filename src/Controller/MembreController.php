<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MembreController extends AbstractController
{
    use HelperTrait;

    /**
     * Création du formulaire d'ajout
     * @Route("/ajouter-un-membre", name="membre_new")
     * @param Request $request
     * @return Response
     */
    public function newMembre(Request $request,UserPasswordEncoderInterface $encoder)
    {
        // Création d'un nouveau membre
        $membre = new Membre();
        $membre->setRoles(['ROLE_MEMBRE']);

        // Création du formulaire d'inscription
        $form = $this->createform(MembreFormType::class, $membre);

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($membre);

            // L'encodgage dut mot depasse
            $membre->setPassword($encoder->encodePassword($membre, $membre->getPassword() ) );


            // Sauvegarder dans la BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            return $this->addFlash(
                'notice',
                'Bravo ! Vous avez ajoutez un utilisateur.'
            );

            return $this->redirectToRoute('security_connexion');
        }

        // Passage à la vue
        return $this->render('membre/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
