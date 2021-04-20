<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Evercode\DependentSelectBundle\Form\Type\DependentFilteredEntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use App\Entity\NotaAlumno;
use App\Entity\Alumno;
use App\Entity\Aula;
use App\Entity\AulaMateria;

final class NotaAdmin extends AbstractAdmin
{
    public function  configure(){
        $this->parentAssociationMapping = 'materiaaula';
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
        ->add('periodo')
        ->add('materiaaula')
        ->add('fecha', null, ['format' => 'd/M/y'])
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
            ->with('Carga de Notas')
                ->add('periodo')
                ->add('materiaaula', null, ['disabled' => $this->getSubject()->getId()? true : false])
                ->add('fecha', DatePickerType::class, ['format' => 'd/M/y'])
            ->end()
        ;
        if($this->getSubject()->getId()):    
            $formMapper
                ->with('Alumnos')
                    ->add('notaAlumnos', CollectionType::class, array(
                        'by_reference' => false, 'label' => false, 'btn_add' => false,  
                        ),
                            array(
                                'edit' => 'inline',
                                'inline' => 'table',
                                'sortable' => 'position'
                            ))
                ->end()
                ;
        endif;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ;
    }

    public function prePersist($object)
    {
        // remove extra white spaces
        $alumnos = $object->getMateriaAula()->getAula()->getAulaAlumnos();
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        #$object->setAula($object->getMateriaAula()->getAula());
        foreach($alumnos as $a):
            #echo $a->getAlumno()->getId();exit;
            $notaAlumno = new NotaAlumno();
            $notaAlumno->setNotaId($object);
            $notaAlumno->setAlumno($a->getAlumno());
            $notaAlumno->setTipoNota($object->getMateriaAula()->getTipoNota());
            $em->persist($notaAlumno);
            $em->flush();
        endforeach;
    }


}
