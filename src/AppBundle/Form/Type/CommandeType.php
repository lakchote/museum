<?php

namespace AppBundle\Form\Type;

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
                'type_billet.choices.full_day_label' => 'journee',
                'type_billet.choices.half_day_label' => 'demi_journee',
                ],
            'placeholder' => 'type_billet.placeholder',
            'expanded' => true,
            'multiple' => false,
            'data' => 'journee',
            'label' => 'type_billet.label'
        ])
            ->add('dateVisite', DateType::class, [
                'attr' => ['class' => 'dateVisite'],
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false,
                'label' => 'date_visite.label'
            ])
            ->add('emailVisiteur', RepeatedType::class,[
                'type' => EmailType::class,
                'first_options' => ['label' => 'email_visiteur.label_first_options'],
                'second_options' => ['label' => 'email_visiteur.label_second_options'],
                'invalid_message' => 'commande.invalid_message',
            ])
            ->add('nbBillets', IntegerType::class,[
                'attr' => ['min' => '1', 'max' => '100'],
                'label' => 'nb_billets.label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
            'translation_domain' => 'commande'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_commande_form_type';
    }
}
