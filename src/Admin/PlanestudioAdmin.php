<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use App\Entity\Anio;

final class PlanestudioAdmin extends AbstractAdmin
{
    

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('codigo')
            ->add('nombre_plan')
            ->add('nombre_carrera')
            ->add('cantidad_anios')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('codigo')
            ->add('nombre_plan')
            ->add('nombre_carrera')
            ->add('cantidad_anios')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    'anioslist' => ['template' => 'aniosAdmin/anios_list.html.twig'],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('codigo')
            ->add('nombre_plan')
            ->add('nombre_carrera')
            ->add('cantidad_anios',null,  ['label' => 'Cantidad de Años', 'disabled' => $this->getSubject()->getId() ? true : false])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('nombre_plan')
            ->add('nombre_carrera')
            ->add('cantidad_anios')
            ;
    }

    
    public function prePersist($object)
    {
        $anioManager = $this->getModelManager()
                ->getEntityManager('App\Entity\Anio');

        for($i = 1; $i <= $object->getCantidadAnios(); $i++):
            $anio = new Anio();
            $anio->setPlanestudio($object);
            $anio->setNumero($i);
            $anioManager->persist($anio);
            $anioManager->flush();
        endfor;

    }
}
