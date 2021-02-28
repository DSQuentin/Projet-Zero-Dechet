<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Repository\VillesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    private $villes;

    public function __construct(VillesRepository $villesRepository)
    {
        $this->villes = $villesRepository->findAll();
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('ville', DatalistType::class, ['choices' => $this->villes])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
