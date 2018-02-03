<?php

namespace MagnetosCompany\MainBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MagnetosCompany\MainBundle\Entity\Device;
use Symfony\Component\Form\AbstractType;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('type', TextType::class)
            ->add('interface', TextType::class)
            ->add('personalId', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'main_bundle_device_form';
    }
}
