<?php

namespace App\Form;


use App\Entity\Annonce;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('featureImage', FileType::class, [
                'attr' => [
                    'class' => 'dropify'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Publier mon Article'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        # Mon formulaire s'attend à reçevoir une instance de Article.
        # Tout autres instances ne fonctionnera pas...
        $resolver->setDefault('data_class', Annonce::class);
    }

    /**
     * Permet de préfixer les champs de votre formulaire.
     * Ex. prefix_nomduchamp
     */
    public function getBlockPrefix()
    {
        return 'form';
    }

}
