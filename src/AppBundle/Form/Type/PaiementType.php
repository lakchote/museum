<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ccNumber', TextType::class, [
            'attr' => ['class' => 'form-control js-cc-number', 'data-stripe' => 'number', 'autocomplete' => 'off', 'size' => '16', 'placeholder' => 'content.form.placeholders.card_number'],
            'label' => 'content.form.labels.card_number'
        ])
            ->add('ccExp', TextType::class, [
                'attr' => ['class' => 'form-control js-cc-exp', 'data-stripe' => 'exp', 'autocomplete' => 'off', 'size' => '4', 'placeholder' => 'content.form.placeholders.mm_yy'],
                'label' => 'content.form.labels.mm_yy'
            ])
            ->add('ccCVV', TextType::class, [
                'attr' => ['class' => 'form-control js-cc-cvc', 'data-stripe' => 'cvc', 'autocomplete' => 'off', 'size' => '4', 'placeholder' => 'content.form.placeholders.cvc'],
                'label' => 'content.form.labels.cvc'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'paiement'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_paiement_type';
    }
}
