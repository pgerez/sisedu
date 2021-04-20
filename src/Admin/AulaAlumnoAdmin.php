<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;

final class AulaAlumnoAdmin extends AbstractAdmin
{
    public function  configure(){
        $this->parentAssociationMapping = 'aula';
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            #->add('id')
            ->add('alumno')
            #->add('_action', null, [
            #    'actions' => [
            #        'show' => [],
            #        'edit' => [],
            #        'delete' => [],
            #    ],
            #])
            ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('alumno',ModelListType::class)
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ;
    }
}
