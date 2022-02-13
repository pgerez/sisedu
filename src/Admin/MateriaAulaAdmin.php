<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\CoreBundle\Form\Type\CollectionType;


final class MateriaAulaAdmin extends AbstractAdmin
{

    public function  configure(){
        $this->parentAssociationMapping = 'aula';
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nota_minima')
            ->add('asistencia')
            ->add('cantidad')
            ->add('aula')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            #->add('id')
            ->add('aniomateria.materia', null, ['label' => 'Materia'])
            ->add('aula')
            ->add('docente')
            ->add('nota_minima')
            ->add('asistencia','choice', [
                'choices' => [
                    '1' => 'Por Dia'
                ], 'label' => 'Tipo de Asistencia'])
            ->add('cantidad')
            ->add('regimen')
            ->add('tipoNota')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => ['label' => 'Configurar'],
                    'delete' => [],
                    'notascreate' => ['template' => 'notaAdmin/notas_create.html.twig']
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('aniomateria',null,  ['label' => 'Materia', 'disabled' => $this->getSubject()->getId() ? true : false])
            ->add('docente',ModelListType::class)
            ->add('nota_minima')
            ->add('asistencia', ChoiceType::class, [
                'choices' => [
                    'Por Dia' => '1'
                    ]]
                )
            ->add('tipo_nota')
            ->add('cantidad')
            ->add('regimen')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('nota_minima')
            ->add('asistencia')
            ->add('cantidad')
            ;
    }
}
