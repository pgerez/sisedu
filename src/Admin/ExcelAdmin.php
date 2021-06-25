<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class ExcelAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('col0')
            ->add('col1')
            ->add('col2')
            ->add('col3')
            ->add('col4')
            ->add('col5')
            ->add('col6')
            ->add('col7')
            ->add('col8')
            ->add('col9')
            ->add('col10')
            ->add('col11')
            ->add('col12')
            ->add('col13')
            ->add('col14')
            ->add('col15')
            ->add('col16')
            ->add('col17')
            ->add('col18')
            ->add('col19')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('col0')
            ->add('col1')
            ->add('col2')
            ->add('col3')
            ->add('col4')
            ->add('col5')
            ->add('col6')
            ->add('col7')
            ->add('col8')
            ->add('col9')
            ->add('col10')
            ->add('col11')
            ->add('col12')
            ->add('col13')
            ->add('col14')
            ->add('col15')
            ->add('col16')
            ->add('col17')
            ->add('col18')
            ->add('col19')
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
            ->add('id')
            ->add('col0')
            ->add('col1')
            ->add('col2')
            ->add('col3')
            ->add('col4')
            ->add('col5')
            ->add('col6')
            ->add('col7')
            ->add('col8')
            ->add('col9')
            ->add('col10')
            ->add('col11')
            ->add('col12')
            ->add('col13')
            ->add('col14')
            ->add('col15')
            ->add('col16')
            ->add('col17')
            ->add('col18')
            ->add('col19')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('col0')
            ->add('col1')
            ->add('col2')
            ->add('col3')
            ->add('col4')
            ->add('col5')
            ->add('col6')
            ->add('col7')
            ->add('col8')
            ->add('col9')
            ->add('col10')
            ->add('col11')
            ->add('col12')
            ->add('col13')
            ->add('col14')
            ->add('col15')
            ->add('col16')
            ->add('col17')
            ->add('col18')
            ->add('col19')
            ;
    }
}
