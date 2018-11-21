<?php

namespace PharmaciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ProductoBundle\Entity\Analisis;


class AnalisisApiController extends Controller
{
    /**
     * @Route("analisis/api/analisis/list", name="analisis_api_category_list")
     */
    public function listAction()
    {
    	 $analisis = $this->getDoctrine()
		    	 ->getRepository('PharmaciaBundle:Analisis')
		    	 ->findAll();

        $response= new Response();
        $response->headers->add([
                                    'Content-Type'=>'application/json'
                                ]);
        $response->setContent(json_encode($analisis));
        return $response;
    }

    /**
     * Creates a new analisis entity.
     *
     * @Route("analisis/api/analisis/new", name="analisis_api_analisis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $analisis = new Analisis();
        $form = $this->createForm('PharmaciaBundle\Form\AnalisisApiType', $analisis);
        $form->handleRequest($request);

        $response= new Response();
        $response->headers->add([
                                    'Content-Type'=>'application/json'
                                ]);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($analisis);
            $em->flush();

            $response->setContent(json_encode($analisis));
        }else{

            $validator = $this->get('validator');
            $errors = $validator->validate($analisis);

            if (count($errors) > 0) {
                $messages=[];

                foreach ($errors as $violation) {
                    $messages[$violation->getPropertyPath()][] = $violation->getMessage();
                }

                $response->setContent(json_encode($messages));
        	}

        	$response->setStatusCode(400);

        }

        return $response;
    }
}