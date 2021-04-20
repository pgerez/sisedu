<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;

final class DocenteAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('telefono')
            ->add('domicilio')
            ->add('email')
            ->add('fecha_nacimiento')
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
            ->add('domicilio')
            ->add('email')
            ->add('fecha_nacimiento')
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
            #->add('id')
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('telefono')
            ->add('domicilio')
            ->add('email')
            ->add('fecha_nacimiento', DatePickerType::class, ['format' => 'd/M/y'])
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
            ->add('domicilio')
            ->add('email')
            ->add('fecha_nacimiento')
            ;
    }
}
