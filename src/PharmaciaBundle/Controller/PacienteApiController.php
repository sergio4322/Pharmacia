<?php

namespace PharmaciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ProductoBundle\Entity\Paciente;

class PacienteApiController extends Controller
{
    /**
     * @Route("pacient/api/pacient/list", name="pacient_api_pacient_list")
     */
    public function listAction()
    {
    	 $pacientes = $this->getDoctrine()
		    	 ->getRepository('PharmaciaBundle:Paciente')
		    	 ->findAll();

        $response= new Response();
        $response->headers->add([
                                    'Content-Type'=>'application/json'
                                ]);
        $response->setContent(json_encode($pacientes));
        return $response;
    }


    /**
     * Creates a new pacient entity.
     *
     * @Route("pacient/api/pacient/new", name="pacient_api_pacient_new")
     * @Method("POST")
     */
    public function newAction(Request $r)
    {
        $paciente = new Paciente();
        $form = $this->createForm(
            'PharmaciaBundle\Form\PacienteApiType',
            $paciente,
            [
                'csrf_protection' => false
            ]
        );
        $form->bind($r);
        $valid = $form->isValid();
        $response = new Response();
        if(false === $valid){
            $response->setStatusCode(400);
            $response->setContent(json_encode($this->getFormErrors($form)));
            return $response;
        }
        if (true === $valid) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();
            $response->setContent(json_encode($paciente));
        }
        return $response;
    }

    public function getFormErrors($form){
        $errors = [];
        if (0 === $form->count()){
            return $errors;
        }
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }
        return $errors;
    }
}
