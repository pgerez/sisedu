<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sonata\AdminBundle\Controller\CRUDController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Certificado;
use App\CertPDF;
use TCPDF;

final class CertificadoAdminController extends CRUDController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    function fechaCastellano ($fecha) 
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return "dia ".$nombredia." ".$numeroDia." de ".$nombreMes." del Año ".$anio;
    }

    /**
     * @param $id
     */
    public function emailAction(EntityManagerInterface $em)
    {
        $a = 0;
        $certificado = $em->getRepository(Certificado::class)->find($this->admin->getSubject()->getId());
        $codigo = $this->pdfcertificadoAction($attachment=true, $em);
        $email = (new Email())
            ->from('certificados@isanpedronolasco-sde.edu.ar');
        if($certificado->getEmail() != null):
            $emails = explode(",",$certificado->getEmail());
            foreach($emails as $e):
                if($a == 0):
                    $email->to($e);
                    $a=1;
                else:
                    $email->addTo($e);
                endif;
            endforeach;
        else:
            foreach($certificado->getAlumno()->getAlumnoTutors() as $at)
            {
                $email_tutor  = $at->getTutor()->getEmail();
            }
            $email->to($email_tutor);
        endif;

        $email
            ->subject((string)$certificado->getTipocertificado())
            ->text('Por favor, NO responda a este mensaje, es un envío automático.')
            ->attachFromPath($this->getParameter('attachment').'certificado-'.$codigo.'.pdf');
            #->html('<p>Texto que proporcionara la Escuela!</p>');
    
        #$encrypter = new SMimeEncrypter('/path/to/certificate.crt');
        #$encryptedEmail = $encrypter->encrypt($email);
        
        $this->mailer->send($email);

        $this->addFlash('success', 'Envio Exitoso!');
        // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()
        unlink($this->getParameter('attachment').'certificado-'.$codigo.'.pdf');
        return $this->redirectToRoute('admin_app_certificado_list');
    }

     

    /**
     * @param $id
     */
    public function pdfcertificadoAction($attachment = null, EntityManagerInterface $em)
    {


        $certificado = $em->getRepository(Certificado::class)->find($this->admin->getSubject()->getId());
        $pdf = new CertPDF();       //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(PDF_AUTHOR);
        $pdf->SetTitle($certificado->getTipocertificado());
        $pdf->SetFont("calibri", "", 15);
        $pdf->setCellHeightRatio(1.5);


        // set style for barcode
        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

        
        $genero = $certificado->getAlumno()->getGenero() == 1 ? 'alumno' : 'alumna';
        $el_la = $certificado->getAlumno()->getGenero() == 1 ? 'el alumno' : 'la alumna';
        $promedio = $certificado->getPromedio() == null ? '':'PROMEDIO: <strong>'.$certificado->getPromedio().'</strong><br>';
        $horaio_escolar = $certificado->getHorarioEscolar() == null ? '': 'Horario Escolar: <strong>'.$certificado->getHorarioEscolar().'</strong><br>';
        $horaio_edu_fisica = $certificado->getHorarioEduFisica() == null ? '': 'Horario Educación Física: <strong>'.$certificado->getHorarioEduFisica().'</strong><br>';
        $objeto_de = $certificado->getObjetoDe() == null ? '': 'con el objeto de <strong>'.$certificado->getObjetoDe().'</strong>';
        ##datos del solicitante####
        $solicitante = 'xxxx';
        $dni         = 'xxxx';
        if($certificado->getNoTutor() == 1)
        {
            $solicitante = $certificado->getSolicitado() == null ? 'xxxx' : $certificado->getSolicitado(); ;
            $dni         = $certificado->getSolicitadoDni() == null ? 'xxxx' : $certificado->getSolicitadoDni();
        }
        else
        {
            foreach($certificado->getAlumno()->getAlumnoTutors() as $at)
            {
                $solicitante = $at->getTutor()->getGenero() == 1 ? 'el <strong>SR. '.$at->getTutor().'</strong>' : 'la <strong>SRA. '.$at->getTutor().'</strong>';
                $solicitante_libredeuda =$at->getTutor()->getGenero() == 1 ? ' padre,  Representante Administrativo  el SR. '.$at->getTutor() : ' madre,  Representante Administrativo  la SRA. '.$at->getTutor();
                $dni         = $at->getTutor()->getDni();
            }

        }

        $del_interesado = $certificado->getDelInteresado() == 0 ? 'A solicitud de <strong>'.$solicitante.'</strong>, D.N.I. Nº <strong>'.$dni.'</strong>':'A pedido del interesado';
        ##datos ciclo lectivo#####
        $ciclo = 'xxxx';
        $nivel = 'xxxx';
        foreach($certificado->getAlumno()->getAulaAlumnos() as $aula)
        {
            if($certificado->getCiclolectivo() == $aula->getAula()->getCiclolectivo()->getYear()):
                $ciclo = $aula->getAula()->getDatosCertificado();
                $cicloyear = $aula->getAula()->getCiclolectivo()->getYear();
                $nivel = $aula->getAula()->getTipoaula() == 1 ? 'Primario' : 'Secundario';
                $orientacion = $aula->getAula()->getModalidad();
            endif;
        }


        ##fecha actual
        $fecha_texto = $this->fechaCastellano(date_format($certificado->getFechaCreacion(),"m/d/Y H:i:s"));

        $pdf->addPage();
        $pdf->setY(50);
        #texo segun tipo de certitifcado###
        $htmlContent = '<p align="center"><strong><u>'.$certificado->getTipocertificado().'</p></strong></u><br>';
        $pdf->SetFont("calibri", "", 14);
        #finalizado
        $inicio_fin = $certificado->getFinalizado() == 1 ? 'finalizado':'iniciado';
        switch($certificado->getTipocertificado()->getId())
        {
            case 3: #Certificado de escolaridad
                $htmlContent .= '<span style="text-align:justify;text-indent: 5em"><br>El Instituto San Pedro Nolasco, Bachillerato Humanista Moderno, certifica que '.$el_la.' <strong>'.$certificado->getAlumno()->getApellido().', '.$certificado->getAlumno()->getNombre().'</strong>, D.N.I. Nº <strong>'.$certificado->getAlumno()->getDni().'</strong>, ha '.$inicio_fin.' el <strong>Ciclo Lectivo '.$cicloyear.'</strong> como '.$genero.' regular del ciclo correspondiente al año '.$certificado->getAAnterior().' en el <strong>'.$ciclo.'</strong> del Nivel '.$nivel.', en este establecimiento educativo.<br>Este certificado se extiende en la ciudad de Santiago del Estero el '.$fecha_texto.' para ser presentado por '.$solicitante.', D.N.I. Nº <strong>'.$dni.'</strong> ante <strong>'.$certificado->getPresentado().'</strong> '.$objeto_de.'</span>';
                if($nivel == 'Primario'){  
                    $pdf->Image(dirname(__FILE__).'/../Resources/images/alumnoregularprimario.jpg', 140, 130, 35, 30, 'JPG');
                }else{  
                    $pdf->Image(dirname(__FILE__).'/../Resources/images/alumnoregularsecundario.jpg', 140, 130, 35, 30, 'JPG');
                }
                break;
            case 2: #Certificado de titulo en tramite
                $htmlContent .= '<span style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La Rectora  del INSTITUTO SAN PEDRO NOLASCO B.H.M.  certifica que '.$el_la.': <strong>'.$certificado->getAlumno()->getApellido().', '.$certificado->getAlumno()->getNombre().'</strong>, de '.$ciclo.' tiene en trámite su certificado Analítico de FINALIZACIÓN  de <strong>'.$orientacion.' QUE SE CORRESPONDE CON LA EDUCACION SECUNDARIA COMPLETA.</strong><br>DATOS CORRESPONDIENTES<br>D.N.I. N ° <strong>'.$certificado->getAlumno()->getDni().'</strong><br>ESPACIOS CURRICULARES QUE ADEUDA: <strong>'.$certificado->getAdeuda().'</strong><br>IDIOMAS EXTRANJEROS CURSADOS: <strong>'.$certificado->getIdioma().'</strong><br>'.$promedio.'A solicitud del interesado/a y al solo efecto de  ser presentado ante <strong>'.$certificado->getPresentado().'</strong> se expide la presente constancia en la ciudad de Santiago del Estero el '.$fecha_texto.'.-</span>';
                $pdf->Image(dirname(__FILE__).'/../Resources/images/tituloentramite.jpg', 140, 170, 50, 30, 'JPG');
                break;
            case 7: #Constancia de Promedio
                $htmlContent .= '<span style="text-align:justify;text-indent: 5em"><br>La Rectora  del INSTITUTO SAN PEDRO NOLASCO B.H.M. hace constar por la presente que '.$el_la.': <strong>'.$certificado->getAlumno()->getApellido().', '.$certificado->getAlumno()->getNombre().'</strong> D.N.I. N ° <strong>'.$certificado->getAlumno()->getDni().'</strong>, se encuentra cursando el '.$ciclo.' del <strong>'.$orientacion.' QUE SE CORRESPONDE CON LA EDUCACION SECUNDARIA.</strong><br>Culminó el <strong>'.$certificado->getAAnterior().'</strong> con un promedio general de <strong>'.$certificado->getPromedio().'</strong><br>A solicitud del interesado/a y al solo efecto de ser presentado ante <strong>'.$certificado->getPresentado().'</strong> se expide la presente constancia en la ciudad de Santiago del Estero el '.$fecha_texto.'.-</span>';
                $pdf->Image(dirname(__FILE__).'/../Resources/images/tituloentramite.jpg', 140, 150, 50, 30, 'JPG');
                break;
            case 5: #Certificado de libre deuda
                $htmlContent .= '<span style="text-align:justify;text-indent: 5em"><br>
                                Por medio de la presente informo a usted en mi carácter de
                                Representante Legal, que '.$el_la.' <strong>'.$certificado->getAlumno()->getApellido().', '.$certificado->getAlumno()->getNombre().'</strong>, D.N.I. Nº <strong>'.$certificado->getAlumno()->getDni().'</strong>
                                , que curso en este establecimiento '.$ciclo.', en el ciclo
                                lectivo '.$cicloyear.'; siendo su '.$solicitante_libredeuda.'
                                DNI '.$dni.' a la fecha no registra pagos pendientes en esta entidad.<br><br>La presente se extiende a pedido de su Tutor, a fin de ser presentados ante las
                                '.$certificado->getPresentado().', en la ciudad de Santiago del Estero, el '.$fecha_texto.'.-</span>';
                $pdf->Image(dirname(__FILE__).'/../Resources/images/libredeuda.jpg', 130, 140, 40, 30, 'JPG');
                break;
            case 1: #Constancia alumno regular
                $htmlContent .= '<span style="text-align:justify; text-indent: 5em"><br>La autoridad que suscribe certifica que '.$el_la.' <strong>'.$certificado->getAlumno()->getApellido().', '.$certificado->getAlumno()->getNombre().'</strong>, D.N.I. N° <strong>'.$certificado->getAlumno()->getDni().'</strong>, es '.$genero.' regular del Instituto San Pedro Nolasco, Bachillerato Humanista Moderno, y cursa en el ciclo lectivo '.$cicloyear.' el <strong>'.$ciclo.'</strong>, del Nivel '.$nivel.'.<br>'.$horaio_escolar.$horaio_edu_fisica.$del_interesado.', y al solo efecto de  ser presentado ante <strong>'.$certificado->getPresentado().'</strong>, se expide la presente constancia en la ciudad de Santiago del Estero el '.$fecha_texto.'.</span>';
                if($nivel == 'Primario'){  
                    $pdf->Image(dirname(__FILE__).'/../Resources/images/alumnoregularprimario.jpg', 140, 130, 35, 30, 'JPG');
                }else{  
                    $pdf->Image(dirname(__FILE__).'/../Resources/images/alumnoregularsecundario.jpg', 140, 130, 35, 30, 'JPG');
                }
                break;
            case 6: #Constancia Pase en Tramite
                $htmlContent .= '<span style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La Rectora  del INSTITUTO SAN PEDRO NOLASCO B.H.M.  certifica que '.$el_la.': <strong>'.$certificado->getAlumno()->getApellido().', '.$certificado->getAlumno()->getNombre().'</strong>, de '.$ciclo.' tiene en trámite su certificado Analítico de PASE de <strong>'.$orientacion.' QUE SE CORRESPONDE CON LA EDUCACION SECUNDARIA INCOMPLETA.</strong><br>DATOS CORRESPONDIENTES<br>D.N.I. N ° <strong>'.$certificado->getAlumno()->getDni().'</strong><br>ESPACIOS CURRICULARES QUE ADEUDA: <strong>'.$certificado->getAdeuda().'</strong><br>IDIOMAS EXTRANJEROS CURSADOS: <strong>'.$certificado->getIdioma().'</strong><br>'.$promedio.'A solicitud del interesado/a y al solo efecto de  ser presentado ante <strong>'.$certificado->getPresentado().'</strong> se expide la presente constancia en la ciudad de Santiago del Estero el '.$fecha_texto.'.-</span>';
                $pdf->Image(dirname(__FILE__).'/../Resources/images/tituloentramite.jpg', 140, 150, 50, 30, 'JPG');
                break;   
        }
        
        $pdf->writeHTML($htmlContent,true,0,true,0);

        
        // QRCODE,H : QR-CODE Best error correction
        $pdf->SetFont("FreeSerif", "", 12);
        $pdf->write2DBarcode('https://isanpedronolasco-sde.edu.ar/validarcertificado?dni='.$certificado->getAlumno()->getDni().'&codigo='.$certificado->getCodigo(), 'QRCODE,H', 20, $pdf->getY()+5, 50, 50, $style, 'N');
        $pdf->Text(33, $pdf->getY(), $certificado->getCodigo());
        #validar desde url
        $pdf->SetFont("FreeSerif", "", 10);
        $htmlContent = '<br><br><br>1- Para validar ingrese a la direccion https://isanpedronolasco-sde.edu.ar/validarcertificado';
        $pdf->writeHTML($htmlContent,true,0,true,0);
        #validar desde QR
        $htmlContent = '<br>2- O escaneé el codigo QR con un celular o dispositivo y acceda directamente al sitio.';
        $pdf->writeHTML($htmlContent,true,0,true,0);
        // ---------------------------------------------------------

        //Close and output PDF document
        if($attachment == false){
            $pdf->Output('certificado-'.$certificado->getCodigo().'.pdf', 'I');
        }else{
            $pdf->Output($this->getParameter('attachment').'certificado-'.$certificado->getCodigo().'.pdf', 'F');
            return $certificado->getCodigo();    
        }
    }


}
