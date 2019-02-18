<?php

namespace App\Form;



use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // formulaire de connexion
        $builder
            ->add('email',EmailType::class,[
                'label'=>false,
                'attr'=>['placeholder' => 'E-Mail']
            ])
            ->add('password', PasswordType::class,[
                'label'=>false,
                'attr'=>['placeholder' => 'Mot de Passe']
            ])
            ->add('Connexion', SubmitType::class,[
                'attr' => ['class'=>'form-control', 'btn', 'btn-custom']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', null);
    }

    public function getBlockPrefix()
    {
        return 'app_login';
    }


}