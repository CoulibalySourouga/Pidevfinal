<?php

namespace App\Form;

use App\Entity\Entretien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description',TextareaType::class,array("attr"=>["class"=>"form-control"]))
            ->add('nomPostulant', TextType::class,array("attr"=>["class"=>"form-control"]))
            ->add('prenomPostulant', TextType::class,array("attr"=>["class"=>"form-control"]))
            ->add('nomRecruteur', TextType::class,array("attr"=>["class"=>"form-control"]))
            ->add('prenomRecruteur', TextType::class,array("attr"=>["class"=>"form-control"]))
            ->add('adresse',TextareaType::class,array("attr"=>["class"=>"form-control"]))
            ->add('dateEntentien',DateType::class,array("attr"=>["class"=>"form-control"]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entretien::class,
        ]);
    }
}
