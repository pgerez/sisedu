<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;

final class AnioAdmin extends AbstractAdmin
{
    public function  configure(){
        $this->parentAssociationMapping = 'planestudio';
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('numero')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            #->add('id')
            ->add('numero')
            ->add('planestudio')
            ->add('anioMaterias', null, ['label' => 'Materias'])
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
            ->add('numero')
            ->add('planestudio', null, ['disabled' => $this->getSubject()->getId() ? true : false])
            ->add('anioMaterias', CollectionType::class,
                ['type_options' => ['delete' => true], 'label' => 'Materias', 'required' => false, 'by_reference' => false],
                [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
                ])
            
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('numero')
            ;
    }
}
