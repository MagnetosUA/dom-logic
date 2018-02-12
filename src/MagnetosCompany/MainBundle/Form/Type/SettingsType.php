<?php

namespace MagnetosCompany\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MagnetosCompany\MainBundle\Entity\Setting;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => ['Запустить' => '1', 'Остановить' => '0'],
                'label' => 'Статус',
            ])
//            ->add('time', ChoiceType::class, [
//                'choices' => [
//                    '2' => '2',
//                    '10' => '10',
//                    '60' => '60',
//                    '300' => '300',
//                    '1200' => '1200',
//                ],
//                'label' => 'Время (с)',
//            ])
            ->add('time', RangeType::class, [
                'attr' => [
                    'min' => 2,
                    'max' => 1200,
                ],
                'label' => 'Время от 2 сек. - до 20 мин',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Setting::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'main_bundle_setting_form';
    }
}