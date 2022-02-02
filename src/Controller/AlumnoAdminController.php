<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sonata\AdminBundle\Controller\CRUDController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\AulaAlumno;
use App\Entity\Aula;
use App\Repository\AulaRepository;
use App\Form\Type\AulaAlumnoType;

final class AlumnoAdminController extends CRUDController
{
    /**
     * @param $id
     */
     public function academicaAction($id): Response
     {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }
        $conn = $this->getDoctrine()->getManager()->getConnection();
        $dni = $object->getDni();
        $sqlSelect = 'SELECT p.nombre_plan as plan, c.year as anio, an.numero as numero, m.nombre as materia, pe.id as idperiodo, pe.nombre as periodo, na.nota as nota, na.id as idnota, au.id as idaula, na.libro as libro, na.folio as folio    
                        FROM Alumno a 
                        JOIN NotaAlumno na on a.id = na.alumno_id 
                        JOIN Nota n on na.nota_id  = n.id 
                        JOIN Periodo pe on pe.id = n.periodo_id 
                        JOIN MateriaAula ma on n.materiaaula_id = ma.id
                        JOIN AnioMateria am on am.id = ma.aniomateria_id 
                        JOIN Materia m on m.id = am.materia_id 
                        JOIN Aula au on ma.aula_id = au.id
                        JOIN Ciclolectivo c on au.ciclolectivo_id = c.id 
                        JOIN Anio an on an.id = au.anio_id 
                        JOIN Planestudio p on an.planestudio_id = p.id 
                        WHERE a.dni = "'.$dni.'" and !ISNULL(na.nota)
                        ORDER BY p.nombre_plan, an.numero, m.nombre, pe.id';
		$stmtSelect = $conn->prepare($sqlSelect);
		$stmtSelect->execute();
		$hacademica = $stmtSelect->fetchAll();

        return $this->render('Alumno/academica.html.twig', array(
                    'object'  => $object,
                    'hacademica'  => $hacademica,
                ));
        
    
     }

     /**
     * @param $id
     */
    public function inscripcionesAction(AulaRepository $aulaRepository, $id, Request $request): Response
    {
       $object = $this->admin->getSubject();
       $error = 0;
       $aulas = $aulaRepository->findByCiclolectivo();

       if (!$object) {
           throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
       }
       
        #$aulaAlumno = new AulaAlumno();
        #$form = $this->createForm(AulaAlumno::class, $aulaAlumno);
        
        #$form->handleRequest($request);
        if ($request->query->get('aulas') <> 0) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            #$task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // ... perform some action, such as saving the task to the database
            $aulaalumno = new AulaAlumno();
            $aulaalumno->setAula($aulaRepository->find($request->query->get('aulas')));
            $aulaalumno->setAlumno($object);
            $em->persist($aulaalumno);
            $em->flush();

            ##flash
            $this->addFlash('sonata_flash_success', 'Inscripcion Exitosa del alumno: '.$object.' en el Aula: '.$aulaRepository->find($request->query->get('aulas')));
            return $this->redirectToRoute('admin_app_alumno_list');
        }else{
            $error = 1;
        }

        return $this->render('Alumno/inscripcion.html.twig', [
            #'form' => $form,
            'aulas'  => $aulas,
            'object' => $object,
            'error'  => $error,
        ]);
       
   
    }

    /**
     * 
     */
    public function listarAction(Request $request): Response
    {   
       $id = $request->request->get('aula_id');
       $aula =  $this->getDoctrine()->getRepository('App:Aula')->find($id);
       $repository = $this->getDoctrine()->getRepository('App:Alumno');             

                $query = $repository->createQueryBuilder('al')
                        #->select('al.apellido as apellido, al.nombre as nombre, al.dni as dni, a.cantidad as cantidad')
                        ->innerJoin('al.aulaAlumnos', 'aa')
                        ->innerJoin('aa.aula', 'a')
                        ->where('a.id = :id')
                        ->setParameters(array(
                                'id' => $id,
                        ))
                        ->getQuery();
                        
                $lista = $query->getResult();
                
                $alumnos = array(
                        'lista' => $lista,
                        'ca' => $aula->getCantidad(),

                );
                
        return $this->render('Alumno/lista.html.twig', $alumnos);
    }

}
