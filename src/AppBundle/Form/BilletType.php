<?php

namespace AppBundle\Form;

use AppBundle\Entity\Billet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, [
            'label' => 'content.label.nom'
        ])
            ->add('prenom', TextType::class, [
                'label' => 'content.label.prenom'
            ])
            ->add('pays', CountryType::class, [
                    'placeholder' => '',
                    'label' => 'content.label.pays'
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => ['placeholder' => 'content.placeholder.date_naissance'],
                'html5' => false,
                'label' => 'content.label.date_naissance'
            ])
            ->add('isTarifReduit', CheckboxType::class,[
                'label' => 'content.label.tarif_reduit',
                'required' => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
            'translation_domain' => 'billets'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_billets_form_type';
    }
}
