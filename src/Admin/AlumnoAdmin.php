<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\CoreBundle\Form\Type\DatePickerType;

final class AlumnoAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        #$collection->add('academica', $this->getRouterIdParameter().'/academica');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombre')
            ->add('apellido')
            ->add('dni')
            #->add('aulaAlumnos.aula',null, ['label' => 'Aula/Curso'])
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
            ->add('legajo')
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('cuit')
            ->add('domicilio')
            ->add('telefono')
            ->add('email')
            ->add('alumnoTutors', null, ['label'=>'Tutor'])
            ->add('_action', null, [
                'actions' => [
                    'show' => ['label' => 'Academica'],
                    'edit' => [],
                    'delete' => [],
                    #'Academica'  => ['template' => 'botones/academica.html.twig'],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('legajo')
            ->add('apellido')
            ->add('nombre')
            ->add('dni')
            ->add('cuit')
            ->add('domicilio')
            ->add('localidad')
            ->add('telefono')
            ->add('email')
            ->add('fecha_nacimiento', DatePickerType::class, ['format' => 'd/M/y'])
            ->add('genero', ChoiceType::class, [
                'choices' => [
                    'Masculino' => '1',
                    'Femenino' => '2'
                ]])
            ->add('lugar_nacimiento', null, ['label' => 'Lugar de Nacimiento'])
            ->add('nacionalidad', ChoiceType::class, [
                'choices' => [
                    'ARGENTINO' => '1',
                ]])
            ->add('fecha_ingreso', DatePickerType::class, ['format' => 'd/M/y'])
            ->add('constancia_titulo')
            ->add('certificado_titulo')
            ->add('observacion')
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
            #->add('id')
            ->add('academica', null, array('template' => 'Alumno/academica.html.twig', 'label' => 'Historia Academica'))
            
            ;
    }
}
