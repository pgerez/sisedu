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

    // public function academicaAction(Request $request)
    // {
    //     $id = $request->query->get('id');

    //     $object = $this->admin->getObject($id);

    //     if (!$object) {
    //         throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
    //     }


    //     return $this->render('App:Alumno:academica.html.twig', array(
    //                 'object'  => $object,
    //             ));
        
    
    // }

}
