<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Villes;
use App\Repository\VillesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class AnnoncesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Echange article contre ...']
            ])
            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Bonjour, j\'échange ceci contre ...']
            ])
            ->add('ville', DatalistType::class, [
                'class' => Villes::class,
                'label' => false,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'attr' => ['placeholder' => 'Sélectionner une ville']
            ])
            ->add('picture', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'https://lien-de-mon-image.com']
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
