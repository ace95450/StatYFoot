<?php

namespace App\Form;


use App\Entity\Membre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'attr' => ['placeholder' => "Nom",
                    'class'=>'form-control']
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => 'Prénom',
                'attr' => ['placeholder' => "Prénom",
                    'class'=>'form-control']
            ])
            ->add('pseudo', TextType::class,[
                'required' => true,
                'label' => 'Pseudo',
                'attr' => ['placeholder' => "Pseudo",
                    'class'=>'form-control']
            ])
            ->add('bio', TextareaType::class, [
                'label' => 'Bio',
                'attr' => ['placeholder' => "...",
                    'rows'=>'4',
                    'class'=>'form-control']
            ])
            ->add('profileFile', FileType::class, [
                'label' => 'Avatar',
                'attr' => [
                    'class' => 'dropify'
                ]
            ])
            /*->add('Leagues', EntityType::class, [
                'class' => Leagues::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'label' => false
            ])*/
            ->add('modifier', SubmitType::class, [
                'attr' => ['class'=>'form-control btn btn-custom']
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        # Mon formulaire s'attend à reçevoir une instance de Article.
        # Tout autres instances ne fonctionnera pas...
        $resolver->setDefault('data_class', membre::class);
    }
    /**
     * Permet de préfixer les champs de votre formulaire.
     */
    public function getBlockPrefix()
    {
        return 'form';
    }
}