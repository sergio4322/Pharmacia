<?php

namespace PharmaciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/paciente/list", name="listaDePacientes")
     */
    public function indexAction()
    {
        if(isset($_GET['busqueda']))
        {
            $busqueda = $_GET['busqueda'];
            $repository = $this->getDoctrine()
                ->getRepository('PharmaciaBundle:Paciente');

            $query = $repository->createQueryBuilder('p')
                ->where('p.name LIKE :nombre')
                ->setParameter('nombre', '%'.$busqueda.'%')
                ->orderBy('p.name', 'ASC')
                ->getQuery();
            $pacientes = $query->getResult();
        }else
        {
    	   $pacientes = $this->getDoctrine()
		    	 ->getRepository('PharmaciaBundle:Paciente')
		    	 ->findAll();
        }
    	return $this->render('PharmaciaBundle:Default:index.html.twig' ,['pacientes'=> $pacientes]);
    }
    
}
