<?php

namespace AppBundle\Form;

use AppBundle\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('typeBillet', ChoiceType::class, [
            'choices' => [
                'Billet Journée' => 'journee',
                'Billet Demi-journée' => 'demi_journee',
                ],
            'placeholder' => 'Type de billet',
        ])
            ->add('dateVisite', DateType::class, [
                'attr' => ['class' => 'dateVisite'],
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false,
            ])
            ->add('emailVisiteur', RepeatedType::class,[
                'type' => EmailType::class,
                'first_options' => ['label' => 'Votre email'],
                'second_options' => ['label' => 'Retapez votre mail'],
            ])
            ->add('nbBillets', IntegerType::class,[
                'attr' => ['min' => '1', 'max' => '100'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_commande_form_type';
    }
}
