<?php

namespace App\Form;


use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // creation formulaire d'inscription
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => 'Nom:',
                'attr' => ['placeholder' => "Nom",
                    'class'=>'form-control mb-2']
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => 'Prénom:',
                'attr' => ['placeholder' => "Prénom",
                    'class'=>'form-control mb-2']
            ])
            ->add('pseudo', TextType::class,[
                'required' => true,
                'label' => 'Pseudo:',
                'attr' => ['placeholder' => "Pseudo",
                    'class'=>'form-control mb-2']
            ])
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => 'E-Mail:',
                'attr' => ['placeholder' => "E-Mail",
                    'class'=>'form-control mb-2']
            ])
            ->add('bio', TextType::class,[
                'required' => true,
                'label' => 'Bio:',
                'attr' => ['placeholder' => "Une courte bio..",
                    'class'=>'form-control mb-2']
            ])
            ->add('password', PasswordType::class,[
                'required' => true,
                'label' => 'Mot de passe:',
                'attr' => ['placeholder' => "Mot de passe",
                    'class'=>'form-control mb-2']
            ])
            ->add('inscription', SubmitType::class, [
                'attr' => ['class'=>'form-control btn btn-custom my-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Les donné qui seront envoyé dans la base ne seront e tne pourrons être que des champs de la base
        // Et rien d'autre
        $resolver->setDefault('data_class', Membre::class);
    }

    public function getBlockPrefix()
    {
        return 'form';
    }

}