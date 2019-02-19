<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\LoginFormType;
use App\Form\MembreFormType;
use App\Form\ProfilFormType;
use function Sodium\crypto_box_publickey_from_secretkey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
        $membre->setAvatar(
            new File($this->getParameter('membre_assets_dir')
            . '/logo.png')
        );

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

            return $this->redirectToRoute('membre_connexion');

        }

        // Passage à la vue
        return $this->render('membre/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="membre_connexion")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function connexion(AuthenticationUtils $authenticationUtils):Response
    {
        $form=$this->createForm(LoginFormType::class,[
            'email' => $authenticationUtils->getLastUsername()
        ]);
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('membre/login.html.twig',[
            'form' => $form->createView(),
            'error' => $error
        ]);

    }
    /**
     * @Route("/deconnexion.html", name="membre_deconnexion")
     */
    public function deconnexion()
    {
    }

    /**
     * @Route("/profil/{id<\d+>}", name="membre_profil")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function profil($id, Request $request)
    {
        // Récupérer les membres de la bdd grace à l'id
        $membre = $this->getDoctrine()
            ->getRepository(Membre::class)
            ->find($id);

        $profil = $this->getDoctrine()->getRepository(Membre::class)->findAll();

        // Récupérer l'avatar
        $avatar = $membre->getAvatar();

        // Création du formulaire profil
        /*
        $membre->setAvatar(
            new File($this->getParameter('membre_assets_dir')
                . '/' . $membre->getAvatar())
        );
        */

        $form = $this->createform(ProfilFormType::class, $membre)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                # Traitement de l'upload de l'avatar du membre
                /** @var UploadedFile $avatar */
                $avatar = $membre->getAvatar();

                # Renommer le nom du fichier
                $fileName = $this->generateUniqueFileName()
                    . '.' . $avatar->guessExtension();

                # Deplacer le fichier vers son répertoire final
                $avatar->move(
                    $this->getParameter('membre_assets_dir'),
                    $fileName
                );

                # Mise à jour de l'avatar
                $membre->setAvatar($fileName);

            # sauvegarde en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            # redirection
            return $this->redirectToRoute('front/home.html.twig');
        }

        return $this->render('membre/profil.html.twig', [
            dump($membre),
            dump($avatar),
            'form' => $form->createView(),
            'membre' => $profil
        ]);

    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
