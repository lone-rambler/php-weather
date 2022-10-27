<?php

namespace App\Form;

use App\Entity\Measurement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datetime')
            ->add('temperature')
            ->add('description')
            ->add('emoji_id', ChoiceType::class, [
                'choices' => [
                    'Słonce -> 1' => 1,
                    'Słońce za chmurami -> 2' => 2,
                    'Pochmurnie -> 3' => 3,
                    'Opad deszczu -> 4' => 4,
                    'Burza -> 5' => 5,
                    'Opad śniegu -> 6' => 6,
                    'Mgła -> 7' => 7,
                ],])
            ->add('location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
