<?php

namespace MagnetosCompany\DispatcherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DispatcherBundle:Default:index.html.twig');
    }
}
