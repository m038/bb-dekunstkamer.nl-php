<?php

namespace m038\KunstkamerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => 'Jan');
    }

	/**
     * @Route("/design_backend")
     * @Template("m038KunstkamerBundle:Backend:base.html.twig")
     */
    public function backendAction()
    {
        return array('name' => 'Jan');
    }
}
