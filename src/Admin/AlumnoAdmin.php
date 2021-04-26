<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\CoreBundle\Form\Type\DatePickerType;

final class AlumnoAdmin extends AbstractAdmin
{
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('dni')
            ->add('aulaAlumnos.aula',null, ['label' => 'Aula/Curso'])
            ->add('genero', null, array(), ChoiceType::class, [
                'choices' => [
                    'Masculino' => '1',
                    'Femenino' => '2'
                ]])
            ->add('domicilio')
            ->add('telefono')
            ->add('email')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('dni')
            ->add('domicilio')
            ->add('telefono')
            ->add('email')
            ->add('alumnoTutors', null, ['label'=>'Tutor'])
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
            ->add('nombre')
            ->add('apellido')
            ->add('dni')
            ->add('cuit')
            ->add('genero', ChoiceType::class, [
                'choices' => [
                    'Masculino' => '1',
                    'Femenino' => '2'
                ]])
            ->add('domicilio')
            ->add('telefono')
            ->add('email')
            ->add('fecha_nacimiento', DatePickerType::class, ['format' => 'd/M/y'])
            ->add('lugar_nacimiento', null, ['label' => 'Lugar de Nacimiento'])
            ->add('fecha_ingreso', DatePickerType::class, ['format' => 'd/M/y'])
            ->add('legajo')
            ->add('localidad')
            ->add('nacionalidad', ChoiceType::class, [
                'choices' => [
                    'ARGENTINO' => '1',
                ]])
            ->add('constancia_titulo')
            ->add('certificado_titulo')
            ->add('alumnoTutors', CollectionType::class, array(
                'by_reference' => false, 'label' => 'Tutor'
            ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position'
                ))
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('dni')
            ->add('domicilio')
            ->add('telefono')
            ->add('email')
            
            ;
    }
}
