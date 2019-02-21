<?php

namespace App\Controller;


use App\Entity\Annonce;
use App\Entity\Membre;
use App\Form\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends  AbstractController
{
    use HelperTrait;

    /**
     * Formulaire pour créer un article
     * @Route("/creer-un-article", name="article_new")
     * @param Request $request
     * @return Response
     */
    public function newArticle(Request $request)
    {
        // Récupération d'un membre

        $membre = $this->getDoctrine()
            ->getRepository(Membre::class)
            ->find(1);

        // Création d'un nouvelle article
        $article = new Annonce();

        // Déclaration d'un auteur à l'article
        $article->setMembre($membre);

        // Création du formulaire
        $form =$this->createForm(ArticleFormType::class);

        // Traitemement du formulaire

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            #dump($article);

            # Traitement de l'upload de l'image
            /** @var UploadedFile $featuredImage */
            $featuredImage = $article->getFeatureImage();

            # Renommer le nom du fichier
            $fileName = $this->slugify($article->getTitre())
                . '.' . $featuredImage->guessExtension();

            # Deplacer le fichier vers son répertoire final
            $featuredImage->move(
                $this->getParameter('articles_assets_dir'),
                $fileName
            );

            # Mise à jour de l'image
            $article->setFeatureImage($fileName);

            # Mise à jour du Slug
            $article->setSlug($this->slugify($article->getTitre()));

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            # Redirection
            return $this->redirectToRoute('front_article', [
                'categorie' => $article->getCategorie()->getSlug(),
                'slug' => $article->getSlug(),
                'id' => $article->getId()
            ]);

        }

        # Passage à la vue du formulaire
        return $this->render('article/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/editer-un-article/{id<\d+>}",
     *     name="article_edit")
     */
    public function editArticle($id, Request $request)
    {
        # Récupérer l'Article en BDD
        $article = $this->getDoctrine()
            ->getRepository(Annonce::class)
            ->find($id);

        # Récupérer la featuredImage
        $featuredImage = $article->getFeatureImage();

        # Création du Formulaire
        $article->setFeatureImage(
            new File($this->getParameter('articles_assets_dir')
                . '/' . $article->getFeatureImage())
        );

        $form = $this->createForm(ArticleFormType::class, $article)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($article->getFeatureImage() != null) {

                # Traitement de l'upload de l'image
                /** @var UploadedFile $featuredImage */
                $featuredImage = $article->getFeatureImage();

                # Renommer le nom du fichier
                $fileName = $this->slugify($article->getTitre())
                    . '.' . $featuredImage->guessExtension();

                # Deplacer le fichier vers son répertoire final
                $featuredImage->move(
                    $this->getParameter('articles_assets_dir'),
                    $fileName
                );

                # Mise à jour de l'image
                $article->setFeatureImage($fileName);

            } else {

                $article->setFeatureImage($featuredImage);

            }

            # Mise à jour du Slug
            $article->setSlug($this->slugify($article->getTitre()));

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            # Redirection
            return $this->redirectToRoute('front_article', [
                'categorie' => $article->getCategorie()->getSlug(),
                'slug' => $article->getSlug(),
                'id' => $article->getId()
            ]);

        }

        return $this->render('article/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}