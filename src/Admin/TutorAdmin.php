<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


final class TutorAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('genero', null, array(), ChoiceType::class, [
                'choices' => [
                    'Masculino' => '1',
                    'Femenino' => '2'
                ]])
            ->add('dni')
            ->add('telefono')
            ->add('email')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('telefono')
            ->add('email')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('apellido')
            ->add('nombre')
            ->add('genero', ChoiceType::class, [
                'choices' => [
                    'Masculino' => '1',
                    'Femenino' => '2'
                ]])
            ->add('dni')
            ->add('telefono')
            ->add('email')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('telefono')
            ->add('email')
            ;
    }
}
