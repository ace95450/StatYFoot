<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/02/2019
 * Time: 08:35
 */

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
        // Création du formulaire via Symfony
        $builder
            ->add('pseudo', TextType::class, [
                'required' => true,
                'label' => 'Pseudo',
                'attr' => ['placeholder' => "Votre pseudo",
                    'class'=>'form-control']
            ])
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'attr' => ['placeholder' => "Votre nom",
                    'class'=>'form-control']
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => 'Prenom',
                'attr' => ['placeholder' => "Votre prénom",
                    'class'=>'form-control']
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email',
                'attr' => ['placeholder' => "Votre email",
                    'class'=>'form-control']
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => "Mot de passe",
                    'class'=>'form-control']
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class'=>'form-control', 'btn', 'btn-primary']
            ]);
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