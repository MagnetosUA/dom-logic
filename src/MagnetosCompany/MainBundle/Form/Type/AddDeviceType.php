<?php

namespace MagnetosCompany\MainBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MagnetosCompany\MainBundle\Entity\Device;
use Symfony\Component\Form\AbstractType;

class AddDeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Activator' => 'Activator',
                    'Sensor' => 'Sensor',
                ]
            ])
            ->add('interface', ChoiceType::class, [
                'choices' => [
                    '1-Wire' => '1-Wire',
                    'Wi-Fi' => 'Wi-Fi',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'main_bundle_add_device_form';
    }
}
