<?php

namespace App\Form;

use App\Entity\Booking;
use App\Form\ApplicationType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BookingType extends ApplicationType
{
    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', TextType::class, $this->getConfiguration(
                "Date de début de votre séjour",
                "La date à laquelle vous comptez arriver",

            ))
            ->add('endDate', TextType::class, $this->getConfiguration(
                "Date de fin de votre séjour",
                "La date à laquelle vous quittez les lieux",

            ))
            ->add('comment', TextareaType::class, $this->getConfiguration(false, "Si vous voulez laisser un commentaire, n'hésitez pas !", [
                'required' => false
            ]));

        $builder->get('startDate')->addModelTransformer($this->transformer);
        $builder->get('endDate')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
            "validation_groups" => ['Default', 'front']
        ]);
    }
}