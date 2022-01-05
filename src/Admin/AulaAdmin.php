<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use App\Entity\MateriaAula;

final class AulaAdmin extends AbstractAdmin
{

    public function  configure(){
        $this->parentAssociationMapping = 'ciclolectivo';
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            #->add('id')
            ->add('numero', null, array(), ChoiceType::class, [
                'choices' => [
                    '1°' => '1',
                    '2°' => '2',
                    '3°' => '3',
                    '4°' => '4',
                    '5°' => '5',
                    '6°' => '5',
                    '7°' => '7'
                ]])
            ->add('tipoaula', null, array(), ChoiceType::class, [
                'choices' => [
                    'Grado' => '1',
                    'Año' => '2'
                ], 'label' => 'Tipo'])
            ->add('seccion')
            ->add('ciclolectivo')
            ->add('modalidad')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            #->add('id')
            ->add('numero', 'choice', [
                'choices' => [
                    '1' => '1°',
                    '2' => '2°',
                    '3' => '3°',
                    '4' => '4°',
                    '5' => '5°',
                    '6' => '6°',
                    '7' => '7°'
                ]])
            #->add('tipoaula', 'choice', [
            #    'choices' => [
            #        '1' => 'Grado',
            #        '2' => 'Año'
            #    ], 'label' => 'Tipo'])
            ->add('seccion')
            ->add('anio', null, ['label' => 'Plan'])
            ->add('ciclolectivo')
            ->add('_action', null, [
                'actions' => [
                    'show' => ['label' => 'Informe'],
                    'edit' => [],
                    'delete' => [],
                    'materiaslist' => ['template' => 'materiaAulaAdmin/materias_list.html.twig'],
                    'alumnoslist' => ['template' => 'alumnosAdmin/alumnos_list.html.twig'],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Aula', ['class' => 'col-md-12'])
            ->end()
            ->with('Alumnos', ['class' => 'col-md-12', 'box_class' => 'box '])
            ->end()
            ->with('Materias', ['class' => 'col-md-12', 'box_class' => 'box '])
            ->end()
            ;

        $formMapper
            #->add('id')
            ->with('Aula')
                ->add('ciclolectivo')
                ->add('anio')
                ->add('numero', ChoiceType::class, [
                    'choices' => [
                        '1°' => '1',
                        '2°' => '2',
                        '3°' => '3',
                        '4°' => '4',
                        '5°' => '5',
                        '6°' => '6',
                        '7°' => '7'
                        ]]
                    )
                ->add('tipoaula', ChoiceType::class, [
                    'choices' => [
                        'Grado' => '1',
                        'Año' => '2'
                        ]]
                    )
                ->add('seccion')
                ->add('modalidad')
            ->end()
            ->with('Alumnos')
                ->add('aulaAlumnos', CollectionType::class, array(
                    'by_reference' => false, 'label' => false
                ),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position'
                    ))
            ->end()
            ->with('Materias')
                ->add('materiaAulas', CollectionType::class, array(
                    'by_reference' => false, 'label' => false
                ),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position'
                    ))
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            #->add('id')
            #->add('__toString', null, ['label' => 'Aula'])
            ->add('alumnos', null, array('label' => null, 'template' => 'AulaShow/alumnos.html.twig'))
            ;
    }

    public function prePersist($object)
    {
        $materiaAulaManager = $this->getModelManager()
                ->getEntityManager('App\Entity\MateriaAula');
        $reg = $this->getModelManager()
                ->getEntityManager('App\Entity\Regimen');

        $regimen  = $reg->getRepository('App\Entity\Regimen')->find(1);
        $tiponota = $reg->getRepository('App\Entity\TipoNota')->find(1);

        foreach($object->getAnio()->getAnioMaterias() as $am):
            $ma = new MateriaAula();
            $ma->setAnioMateria($am);
            $ma->setAula($object);
            $ma->setNotaMinima(6);
            $ma->setCantidad(2);
            $ma->setRegimen($regimen);
            $ma->setTipoNota($tiponota);
            $ma->setAsistencia(1);
            $materiaAulaManager->persist($ma);
            $materiaAulaManager->flush();
        endforeach;

    }
}
