<?php

namespace AppBundle\Form;

use AppBundle\Entity\Billets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, [
            'attr' => ['value' => ''],
        ])
            ->add('prenom', TextType::class, [
                'attr' => ['value' => ''],
            ])
            ->add('pays', CountryType::class, [
                    'attr' => ['value' => ''],
            ])
            ->add('date_naissance', BirthdayType::class, [
                'widget' => 'single_text',
                'attr' => ['value' => ''],
            ])
            ->add('isTarifReduit', CheckboxType::class,[
                'label' => 'Tarif réduit'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Billets::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_billets_form_type';
    }
}
