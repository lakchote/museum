<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeFormType extends AbstractType
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
                'html5' => false,
            ])
            ->add('emailVisiteur', EmailType::class, [
                'attr' => ['placeholder' => 'votre_email@gmail.com']
            ])
            ->add('secondEmail', EmailType::class)
            ->add('nbBillets', IntegerType::class,[
                'attr' => ['min' => '1', 'max' => '100']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeModel::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_commande_form_type';
    }
}
