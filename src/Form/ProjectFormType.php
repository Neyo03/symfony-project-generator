<?php

// src/Form/ProjectFormType.php
namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentStep = $options['current_step'];

        if ($currentStep === 'choose_name') {
            $builder->add('name', TextType::class, [
                'label' => 'Project Name',
                'attr' => [
                    'placeholder' => 'NameProject',
                ],
            ]);
        }

        if ($currentStep === 'choose_php_version') {
            $builder->add('phpVersion', ChoiceType::class, [
                'label' => 'PHP Version',
                'choices' => [
                    '7.4' => '7.4',
                    '8.0' => '8.0',
                    '8.1' => '8.1',
                ],
            ]);
        }

        if ($currentStep === 'choose_symfony_version') {
            $builder->add('symfonyVersion', ChoiceType::class, [
                'label' => 'Symfony Version',
                'choices' => [
                    '5.4' => '5.4',
                    '6.0' => '6.0',
                ],
            ]);
        }

        if ($currentStep === 'choose_database') {
            $builder->add('database', ChoiceType::class, [
                'label' => 'Database',
                'choices' => [
                    'MySQL' => 'mysql',
                    'PostgreSQL' => 'postgresql',
                ],
            ]);
        }

        if ($currentStep === 'choose_destination_folder') {
            $builder->add('destinationFolder', TextType::class, [
                'label' => 'Destination Folder',
                'attr' => [
                    'placeholder' => '/path/to/your/project',
                ],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'current_step' => 'choose_name',
        ]);

        $resolver->setAllowedTypes('current_step', 'string');
    }
}
