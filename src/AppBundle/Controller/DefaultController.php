<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CaseFileType;
use AppBundle\Entity\CaseFile;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'form' => $this->generateForm()->createView()
        ]);
    }

    /**
     * @Route("/", name="save")
     * @Method("POST")
     */
    public function saveAction(Request $request)
    {
        $form = $this->generateForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            var_dump($form->getData());
            die('VALID');
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView()
        ]);
    }


    private function generateForm(CaseFile $entity = null)
    {
        return $this->createForm(
            new CaseFileType(),
            $entity ?: new CaseFile(),
            array(
                'action' => $this->generateUrl('save'),
                'method' => 'POST',
            )
        );
    }
}
