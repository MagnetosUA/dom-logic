<?php

namespace MagnetosCompany\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction()
    {
        return $this->render('MainBundle:Default:home.html.twig');
    }
}
