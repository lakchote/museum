<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowBilletsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('billets', CollectionType::class,[
            'entry_type' => BilletType::class,
            'label' => '',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_show_billets_form_type';
    }
}
