<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



final class CertificadoAdmin extends AbstractAdmin
{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('pdfcertificado', $this->getRouterIdParameter().'/pdfcertificado');
        $collection->add('email', $this->getRouterIdParameter().'/email');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('tipocertificado')
            ->add('alumno')
            ->add('fecha_expiracion')
            ->add('codigo')
            ->add('email')
            ->add('deshabilitado')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('tipocertificado')
            ->add('alumno')
            ->add('fecha_creacion')
            ->add('codigo')
            #->add('email')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'Certificado'  => ['template' => 'botones/pdfcertificados.html.twig'],
                    'Email'  => ['template' => 'botones/email.html.twig'],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Certificado')
                ->add('tipocertificado', null, ['label' => 'Tipo de Certificado'])
                ->add('fecha_creacion', DatePickerType::class, ['format' => 'd/M/y'])
                ->add('fecha_expiracion', DatePickerType::class, ['format' => 'd/M/y'])
                ->add('codigo', null , ['attr' => ['readonly' =>  true ], 'help' => 'Codigo Alfanumerico Generado Automaticamente'])
                ->add('presentado', null, ['label' => 'Para ser presentado ante?'])
                ->add('alumno',ModelListType::class, ['btn_add' => false])
                ->add('ciclolectivo')
                ->add('email', null, ['attr' => ['data-role' => 'tagsinput'],'required' => false, 'label' => 'Email Destinatario', 'help' => 'Si desea enviar a mas de un destinatario separar los mails por ",".  Si el campo queda vacio se enviara al mail del tutor del Alumno.'])
                ->add('deshabilitado')
            ->end();
        
        $formMapper
            ->with('Solicitante')
                ->add('notutor', null,['label' => 'No Tutor'])
                ->add('solicitado', null,['label' => 'Quien solicita?'])
                ->add('solicitado_dni', null,['label' => 'Dni'])
                
            ->end();

        if($this->getSubject()->getId()){
            if($this->getSubject()->getTipoCertificado()->getId() == 2){   
            $formMapper
                ->with('Analitico')
                    ->add('adeuda')
                    ->add('idioma')
                    ->add('promedio')
                ->end();
            }
            if($this->getSubject()->getTipoCertificado()->getId() == 6){   
            $formMapper
                ->with('Pase en Tramite')
                    ->add('adeuda')
                    ->add('idioma')
                ->end();
            }
            if($this->getSubject()->getTipoCertificado()->getId() == 3){ 
            $formMapper
                ->with('Escolaridad')
                    ->add('a_anterior', null, ['label' => 'Correspondiente al año'])
                    ->add('objeto_de')
                    ->add('finalizado')
                ->end();
            }
            if($this->getSubject()->getTipoCertificado()->getId() == 7){ 
            $formMapper
                ->with('Promedio')
                    ->add('a_anterior', null, ['label' => 'Año Anterior'])
                    ->add('promedio')
                ->end();
            }
            if($this->getSubject()->getTipoCertificado()->getId() == 1){ 
            $formMapper
                ->with('Alumno Regular')
                    ->add('horario_escolar')
                    ->add('horario_edu_fisica')
                    ->add('del_interesado')
                ->end();
            }
        }
        
        
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            #->add('numero')
            ->add('codigo')
            ->add('email')
            ->add('tipocertificado')
            ;
    }

    public function prePersist($object)
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $object->setCodigo(substr(str_shuffle($permitted_chars), 0, 8));   
    }


}
