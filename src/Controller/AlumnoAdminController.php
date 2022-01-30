<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sonata\AdminBundle\Controller\CRUDController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

}
