<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Villes;
use App\Repository\VillesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class AnnoncesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('ville', DatalistType::class, [
                'class' => Villes::class,
                'label' => 'Villes',
                'choice_label' => 'name',
                'choice_value' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
