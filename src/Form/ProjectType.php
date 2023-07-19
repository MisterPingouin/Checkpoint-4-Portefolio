<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'block w-full px-4 py-2 mt-2 text-gray-800 bg-gray-200 border border-gray-300 
                rounded-md focus:border-blue-500 focus:outline-none focus:ring'],
                'label_attr' => ['class' => 'block text-gray-800'],
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'block w-full px-4 py-2 mt-2 text-gray-800 bg-gray-200 border
                border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring'],
                'label_attr' => ['class' => 'block text-gray-800'],
            ])
            ->add('image', TextType::class, [
                'attr' => ['class' => 'block w-full px-4 py-2 mt-2 text-gray-800 bg-gray-200 border
                border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring'],
                'label_attr' => ['class' => 'block text-gray-800'],
            ])
            ->add('video', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'block w-full px-4 py-2 mt-2 text-gray-800 bg-gray-200 border
                border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring'],
                'label_attr' => ['class' => 'block text-gray-800'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
