<?php

namespace App\Form;

use App\Entity\Presentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fonction', null, [
                'attr' => ['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full
                sm:text-sm border-gray-300 rounded-md mt-2 ']
            ])
            ->add('description', null, [
                'attr' => ['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full
                sm:text-sm border-gray-300 rounded-md mt-2 ']
            ])
            ->add('link', null, [
                'attr' => ['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full
                sm:text-sm border-gray-300 rounded-md mt-2 ']
            ])
            ->add('project', null, [
                'attr' => ['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full 
                sm:text-sm border-gray-300 rounded-md mt-2 ']
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'inline-flex items-center px-4 py-2 border border-transparent 
                rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 mt-2 
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'],
                'label' => $options['button_label']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presentation::class,
            'button_label' => 'Submit'
        ]);
    }
}
