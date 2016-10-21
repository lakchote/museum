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
            'attr' => ['name' => 'nom'],
        ])
            ->add('prenom', TextType::class
            )
            ->add('pays', CountryType::class, [
                    'attr' => ['required' => 'required'],
                    'placeholder' => '',
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => ['placeholder' => '01/01/1990'],
                'html5' => false,
            ])
            ->add('isTarifReduit', CheckboxType::class,[
                'label' => 'Tarif réduit'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Billet::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_billets_form_type';
    }
}
