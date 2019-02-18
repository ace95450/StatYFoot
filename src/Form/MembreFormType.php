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
        // creation formulaire d'inscription
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
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => 'E-Mail',
                'attr' => ['placeholder' => "E-Mail",
                    'class'=>'form-control']
            ])
            ->add('password', PasswordType::class,[
                'required' => true,
                'label' => 'Mot de passe',
                'attr' => ['placeholder' => "••••••••",
                    'class'=>'form-control']
            ])
            ->add('inscription', SubmitType::class, [
                'attr' => ['class'=>'form-control', 'btn', 'btn-custom']
            ]);
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