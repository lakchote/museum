<?php

namespace AppBundle\Form;

use AppBundle\Entity\Billets;
use AppBundle\Entity\Commandes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowBilletsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('billets', CollectionType::class,[
            'entry_type' => BilletsFormType::class,
            'allow_add' => true,
            'label' => '',
        ])
            ->add('id', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_show_billets_form_type';
    }
}
