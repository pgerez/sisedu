<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\Certificado;
// use App\Entity\Alumno;
// use App\Entity\Tutor;
// use App\Entity\AlumnoTutor;
// use App\Entity\AulaAlumno;
// use App\Entity\Aula;
// use App\Entity\Anio;
// use App\Entity\AnioMateria;
// use App\Entity\Materia;
// use App\Entity\Localidad;
// use App\Entity\Nota;
// use App\Entity\NotaAlumno;
// use App\Entity\Periodo;
// use App\Entity\Excel;
// use App\Entity\Ciclolectivo;
// use App\Entity\MateriaAula;

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
    //     // $arch = ['1ga.csv','1gb.csv','1gc.csv',
    //     //         '2ga.csv','2gb.csv','2gc.csv',
    //     //         '3ga.csv','3gb.csv','3gc.csv',
    //     //         '4ga.csv','4gb.csv','4gc.csv',
    //     //         '5ga.csv','5gb.csv','5gc.csv',
    //     //         '6ga.csv','6gb.csv','6gc.csv',
    //     //         '7ga.csv','7gb.csv','7gc.csv',
    //     //         '1aa.csv','1ab.csv','1ac.csv',
    //     //         '2aa.csv','2ab.csv','2ac.csv',
    //     //         '3aa.csv','3ab.csv','3ac.csv',
    //     //         '4aa.csv','4ab.csv','4ac.csv',
    //     //         '5aa.csv','5ab.csv','5ac.csv'
    //     //         ];
                
    //     #foreach($arch as $a):
    //         $path = '/datos/web/symfony-docker/sicer.app/docs/escuelacsv/ALUMNOS.csv';
    //         #echo __DIR__;exit;
    //         #echo '<br>'.$a;
    //         $lines = file($path);
    //         #$utf_lines = array_map('utf8_decode',$lines);
    //         $utf_lines = array_map(null,$lines);
    //         $em = $this->getDoctrine()->getManager();
    //         foreach(array_map('str_getcsv',$utf_lines) as $line):
    //             #alumno
    //             echo $line[0].'<br>';
    //             $alumno = new Alumno();
    //             $apeynom = explode(",", $line[2]);
                
    //             if(count($apeynom) > 1):
    //                 $alumno->setApellido(mb_strtoupper($apeynom[0],'UTF-8'));
    //                 $alumno->setNombre(mb_strtoupper($apeynom[1],'UTF-8'));
    //             else:
    //                 $alumno->setApellido(mb_strtoupper($apeynom[0],'UTF-8'));
    //                 $alumno->setNombre(mb_strtoupper($apeynom[0],'UTF-8'));
    //             endif;
    //             $alumno->setDni($line[0]);
    //             $alumno->setDomicilio(mb_strtoupper($line[4],'UTF-8'));
    //             $alumno->setEmail('');
    //             if($line[6] != null):
    //                 $datefn = \DateTime::createFromFormat('m/d/Y', $line[6]);
    //                 #var_dump($datefn);exit;
    //                 $alumno->setFechaNacimiento($datefn);
    //             endif;
    //             if($line[11] != null):
    //                 $datefi = \DateTime::createFromFormat('m/d/Y', $line[11]);
    //                 $alumno->setFechaIngreso($datefi);
    //             endif;
    //             $alumno->setNacionalidad(1);
    //             $alumno->setLocalidad($em->getRepository(Localidad::class)->find(1));
    //             $alumno->setLugarNacimiento($line[7]);
    //             $alumno->setTelefono(111111111);
    //             $alumno->setMateriaAdeudada(mb_strtoupper($line[13],'UTF-8'));
    //             $alumno->setObservacion(mb_strtoupper($line[12],'UTF-8'));
    //             $alumno->setLegajo($line[9]);
    //             if($line[3] == 'M'):
    //                 $alumno->setGenero(1);
    //             else:
    //                 $alumno->setGenero(2);
    //             endif;
    //             $em->persist($alumno);
    //             $em->flush();

    //             // #aula_alumno
    //             // $aual = new AulaAlumno();
    //             // $aual->setAlumno($alumno);
    //             // $aual->setAula($em->getRepository(Aula::class)->find($line[7]));
    //             // $em->persist($aual);
    //             // $em->flush();

    //             // #tutor
    //             // $tutor = new Tutor();
    //             // $tutor->setApellido(mb_strtoupper($line[8],'UTF-8'));
    //             // $tutor->setNombre(mb_strtoupper($line[9],'UTF-8'));
    //             // $tutor->setDni($line[10]==''?1111111:$line[10]);
    //             // $tutor->setDomicilio($line[11]);
    //             // $tutor->setEmail($line[12]);
    //             // $tutor->setTelefono($line[13].'/'.$line[14]);
    //             // $em->persist($tutor);
    //             // $em->flush();

    //             // #alumno_tutor
    //             // $altu = new AlumnoTutor();
    //             // $altu->setAlumno($alumno);
    //             // $altu->setTutor($tutor);
    //             // $em->persist($altu);
    //             // $em->flush();

    //         endforeach;
    //     #endforeach;
        
    // }
    
    // /**
    //  * @Route("/importMaterias", methods={"GET","HEAD"})
    //  */
    // public function importMaterias()
    // {
    //     ini_set('max_execution_time', 300);
            
    //         $em = $this->getDoctrine()->getManager();


    //         $anios = $em->getRepository(Anio::class)->findAll();

    //         foreach($anios as $anio):
    //             $path = '/datos/web/symfony-docker/sicer.app/docs/escuelacsv/MATERIAS-1.csv';
    //             #echo __DIR__;exit;
    //             #echo '<br>'.$a;
    //             $lines = file($path);
    //             #$utf_lines = array_map('utf8_decode',$lines);
    //             $utf_lines = array_map(null,$lines);

    //             foreach(array_map('str_getcsv',$utf_lines) as $line):
    //                 #alumno
                    
    //                 #echo $line[0].'<br>';
    
    //                 $m = $em->getRepository(Materia::class)->findNombre($line[1]);
                    
    //                 if($m == null):
    //                     $materia = new Materia();
    //                     $materia->setNombre($line[1]);
    //                     $em->persist($materia);
    //                     $em->flush();
    //                 else:
    //                     $materia = $m;
    //                 endif;    
                    
    //                 if($line[4] == $anio->getPlanestudio()->getCodigo() and $line[2] == $anio->getNumero()):
    //                     $am = new AnioMateria();
    //                     $am->setCodigo($line[0]);
    //                     $am->setMateria($materia);
    //                     $am->setAnio($anio);
    //                     $em->persist($am);
    //                     $em->flush();
    //                 endif;
    
    //             endforeach;

    //         endforeach;
            
    //     #endforeach;
        
    // }

    // /**
    //  * @Route("/generarAulas", methods={"GET","HEAD"})
    //  */
    // public function generarAulas(EntityManagerInterface $em)
    // {
    //     ini_set('max_execution_time', 10000);
    //     $dateImmutable = new \DateTime('@'.strtotime('now'));
    //         #$em = $this->getDoctrine()->getManager();
    //         #$ema = $this->getDoctrine()->getManager();

    //         $excels = $em->getRepository(Excel::class)->findAnioEspCurso();
    //         $anio =  'Z';
    //         $regimen  = $em->getRepository('App\Entity\Regimen')->find(1);
    //         $tiponota = $em->getRepository('App\Entity\TipoNota')->find(1);
            
    //         foreach($excels as $excel):
    //                     #echo '-----'.$anio.' | '.$excel['col13'].'<br> ';#var_dump($excel);exit;
    //                 if($anio != $excel['col13']):
    //                     #echo 'NO----'.$anio.' | '.$excel['col13'].' : fin<br> ';#var_dump($excel);exit;
    //                     #echo ' | ';exit;
    //                     $ciclolectivo = new Ciclolectivo();
    //                     $ciclolectivo->setYear($excel['col13']);
    //                     if($excel['col13'] != '' and $excel['col13'] != 0):
    //                         $ciclolectivo->setFechaInicio(\DateTime::createFromFormat('m/d/Y', '1/1/'.$excel['col13']));
    //                         $ciclolectivo->setFechaFin(\DateTime::createFromFormat('m/d/Y', '12/20/'.$excel['col13']));
    //                     else:
    //                         $ciclolectivo->setFechaInicio(\DateTime::createFromFormat('m/d/Y', '1/1/1998'));
    //                         $ciclolectivo->setFechaFin(\DateTime::createFromFormat('m/d/Y', '12/20/1998'));
    //                     endif;
    //                     $em->persist($ciclolectivo);
    //                     $em->flush();
    //                     $anio = $excel['col13'];
    //                 endif;
    //                 #echo '2';exit;
    //                 echo $excel['col3'].'-'.$excel['col2'].'<br>';
    //                 $an = $em->getRepository('App\Entity\Anio')->findByPlanCurso($excel['col3'],$excel['col2']);
    //                 #echo var_dump($an);exit;
    //                 if($an):
    //                     $aula = new Aula();
    //                     #echo $ciclolectivo->getId().'<br>';
    //                     $aula->setCiclolectivo($ciclolectivo);
    //                     $aula->setAnio($an);
    //                     $aula->setNumero($excel['col2']);
    //                     $aula->setTipoaula(1);
    //                     $aula->setModalidad($em->getRepository('App\Entity\Modalidad')->find(4));
    //                     $em->persist($aula);
    //                     $em->flush();
                        

    //                     foreach($aula->getAnio()->getAnioMaterias() as $am):
    //                         #echo var_dump($am);exit;
    //                         $ma = new MateriaAula();
    //                         $ma->setAnioMateria($am);
    //                         $ma->setAula($aula);
    //                         $ma->setNotaMinima(6);
    //                         $ma->setCantidad(2);
    //                         $ma->setRegimen($regimen);
    //                         $ma->setTipoNota($tiponota);
    //                         $ma->setAsistencia(1);
    //                         $em->persist($ma);
    //                         $em->flush();


    //                         for($i = 1; $i <= 7; $i++):
    //                             $nota = new Nota();
    //                             $nota->setPeriodo($em->getRepository(Periodo::class)->find($i));
    //                             $nota->setMateriaAula($ma);
    //                             $nota->setFecha($dateImmutable);
    //                             $em->persist($nota);
    //                             $em->flush();

    //                             #$alumnos = $em->getRepository('App\Entity\Modalidad')->findDni($excel['col0']);

    //                             #foreach($alumnos as $alu):
    //                             #    $notaAlumno = new NotaAlumno();
    //                             #    $notaAlumno->setNotaId($nota);
    //                             #    $notaAlumno->setAlumno($alu->getAlumno());
    //                             #    $notaAlumno->setTipoNota($nota->getMateriaAula()->getTipoNota());
    //                             #    $em->persist($notaAlumno);
    //                             #    $em->flush();
    //                             #endforeach;
    //                         endfor;

    //                     endforeach;
    //                 endif;
    
    //         endforeach;
    //         #exit;
    //     #endforeach;
        
    // }

    // /**
    //  * @Route("/importAlumnos", methods={"GET","HEAD"})
    //  */
    // public function importAlumnos()
    // {
    //     ini_set('max_execution_time', 2000);
            
    //         $em = $this->getDoctrine()->getManager();


    //         $aulas = $em->getRepository(Aula::class)->findAll();

    //         foreach($aulas as $aula):

    //                 $alumnos = $em->getRepository(Excel::class)->findAlumnos($aula->getCiclolectivo()->getYear(), $aula->getAnio()->getPlanestudio()->getCodigo(), $aula->getAnio()->getNumero());
    //                 foreach($alumnos as $alumno):
    //                     $alu = $em->getRepository(Alumno::class)->findDni($alumno['col0']);

    //                     if($alu):
    //                         #if(!$em->getRepository(AulaAlumno::class)->findDni($aula->getId(),$alu->getId())):
    //                             #$alumno = $em->getRepository(Alumno::class)->findDni($line[0]);
    //                             $aa = new AulaAlumno();
    //                             $aa->setAlumno($alu);
    //                             $aa->setAula($aula);
    //                             $em->persist($aa);
    //                             $em->flush();
    //                         #endif;
    //                     else:
    //                         echo $alumno['col0'].'<br>';
    //                     endif;
    //                     #foreach($aula->getAnio()->getAnioMaterias() as $am):
    //                     #    if($am->getMateria()->getCodigo() == $line[1]):

    //                     #    endif;
                        
    //                     #endforeach;

    //                 endforeach;


    //         endforeach;
            
    //     #endforeach;
        
    // }
    
    //  /**
    //  * @Route("/importNotas", methods={"GET","HEAD"})
    //  */
    // public function importNotas()
    // {
    //     $dateImmutable = new \DateTime('@'.strtotime('now'));
    //     ini_set('max_execution_time', 40000);
            
    //         $em = $this->getDoctrine()->getManager();


    //         // $aulas = $em->getRepository(Aula::class)->findAll();

    //         // foreach($aulas as $aula):

    //         //     foreach($aula->getMateriaAulas() as $materiaaula):

    //         //         foreach($materiaaula->getNotas() as $nota):

    //         //             $alumnos = $materiaaula->getAula()->getAulaAlumnos();
                    
    //         //             foreach($alumnos as $a):
    //                     $excels = $em->getRepository(Excel::class)->findPrevias();
                            
    //                     foreach($excels as $excel):
    //                         echo $excel->getId().'<br>';
    //                         $materiaaulas = $em->getRepository(MateriaAula::class)->findByCodmateriaCursoPlanYear($excel->getCol1(),$excel->getCol2(),$excel->getCol3(),$excel->getCol13());
    //                         foreach($materiaaulas as $materiaaula):
    //                             $nota = new Nota();
    //                             $nota->setPeriodo($em->getRepository(Periodo::class)->find(8));
    //                             $nota->setMateriaAula($materiaaula);
    //                             $nota->setFecha(\DateTime::createFromFormat('m/d/Y', $excel->getCol15()));
    //                             $em->persist($nota);
    //                             $em->flush();


    //                             $notaAlumno = new NotaAlumno();
    //                             $notaAlumno->setNotaId($nota);
    //                             $notaAlumno->setAlumno($em->getRepository(Alumno::class)->findDni($excel->getCol0()));
    //                             $notaAlumno->setTipoNota($nota->getMateriaaula()->getTipoNota());
    //                             $notaAlumno->setNota($excel->getCol14());
    //                             $notaAlumno->setExamenlibro($excel->getCol16());
    //                             $notaAlumno->setExamenfolio($excel->getCol17());
    //                             $em->persist($notaAlumno);
    //                             $em->flush();
    //                         endforeach;
    //                     endforeach;
        
    // }
    
}
