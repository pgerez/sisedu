<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;

final class CiclolectivoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('year')
            ->add('fecha_inicio')
            ->add('fecha_fin')
            ->add('descripcion')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('year')
            ->add('fecha_inicio')
            ->add('fecha_fin')
            ->add('descripcion')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    'aulalist' => ['template' => 'aulaAdmin/aula_list.html.twig'],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            #->add('id')
            ->add('year',null,['label' => 'Año'])
            ->add('fecha_inicio', DatePickerType::class, ['format' => 'd/M/y'])
            ->add('fecha_fin', DatePickerType::class, ['format' => 'd/M/y'])
            ->add('descripcion')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('year')
            ->add('fecha_inicio')
            ->add('fecha_fin')
            ->add('descripcion')
            ;
    }
}
