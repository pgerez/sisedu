<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use App\Entity\Certificado;
use App\Entity\Alumno;
use App\Entity\Tutor;
use App\Entity\AlumnoTutor;
use App\Entity\AulaAlumno;
use App\Entity\Aula;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/validarcertificado", methods={"GET","HEAD"})
     */
    public function validar(Request $request)
    {
        $codigo = '';
        $dni = '';
        if ($request->query->get('codigo') <> '' or $request->query->get('dni') <> '') {
                // perform some action...
                $codigo = $request->query->get('codigo');
                $dni = $request->query->get('dni');
                $em = $this->getDoctrine()->getManager();
                $resultado = $em->getRepository('App:Certificado')->findByCodigoDni($codigo,$dni);
                return $this->render('front/validar.html.twig', [
                    'controller_name' => 'FrontController',
                    'resultado' => $resultado,
                    'codigo' => $codigo,
                    'dni' => $dni
                ]);
        }
        $this->resultado = 1;
        return $this->render('front/validar.html.twig', [
            'controller_name' => 'FrontController',
            'resultado' => $this->resultado,
            'codigo' => $codigo,
            'dni' => $dni
        ]);
    }

    // /**
    //  * @Route("/import", methods={"GET","HEAD"})
    //  */
    // public function import()
    // {
    //     ini_set('max_execution_time', 300);
    //     $arch = ['1ga.csv','1gb.csv','1gc.csv',
    //             '2ga.csv','2gb.csv','2gc.csv',
    //             '3ga.csv','3gb.csv','3gc.csv',
    //             '4ga.csv','4gb.csv','4gc.csv',
    //             '5ga.csv','5gb.csv','5gc.csv',
    //             '6ga.csv','6gb.csv','6gc.csv',
    //             '7ga.csv','7gb.csv','7gc.csv',
    //             '1aa.csv','1ab.csv','1ac.csv',
    //             '2aa.csv','2ab.csv','2ac.csv',
    //             '3aa.csv','3ab.csv','3ac.csv',
    //             '4aa.csv','4ab.csv','4ac.csv',
    //             '5aa.csv','5ab.csv','5ac.csv'
    //             ];
                
    //     foreach($arch as $a):
    //         $path = '/home/gerez/web/sicer.app/docs/import_bd/'.$a;
    //         echo '<br>'.$a;
    //         $lines = file($path);
    //         #$utf_lines = array_map('utf8_decode',$lines);
    //         $utf_lines = array_map(null,$lines);
    //         $em = $this->getDoctrine()->getManager();
    //         foreach(array_map('str_getcsv',$utf_lines) as $line):
    //             #alumno
    //             echo '.';
    //             $alumno = new Alumno();
    //             $alumno->setApellido(mb_strtoupper($line[1],'UTF-8'));
    //             $alumno->setNombre(mb_strtoupper($line[2],'UTF-8'));
    //             $alumno->setDni($line[3]);
    //             $alumno->setDomicilio($line[4]);
    //             $alumno->setEmail($line[5]);
    //             $alumno->setTelefono($line[6]);
    //             $alumno->setGenero(1);
    //             $em->persist($alumno);
    //             $em->flush();

    //             #aula_alumno
    //             $aual = new AulaAlumno();
    //             $aual->setAlumno($alumno);
    //             $aual->setAula($em->getRepository(Aula::class)->find($line[7]));
    //             $em->persist($aual);
    //             $em->flush();

    //             #tutor
    //             $tutor = new Tutor();
    //             $tutor->setApellido(mb_strtoupper($line[8],'UTF-8'));
    //             $tutor->setNombre(mb_strtoupper($line[9],'UTF-8'));
    //             $tutor->setDni($line[10]==''?1111111:$line[10]);
    //             $tutor->setDomicilio($line[11]);
    //             $tutor->setEmail($line[12]);
    //             $tutor->setTelefono($line[13].'/'.$line[14]);
    //             $em->persist($tutor);
    //             $em->flush();

    //             #alumno_tutor
    //             $altu = new AlumnoTutor();
    //             $altu->setAlumno($alumno);
    //             $altu->setTutor($tutor);
    //             $em->persist($altu);
    //             $em->flush();

    //         endforeach;
    //     endforeach;
        
    // }
    
    
}
