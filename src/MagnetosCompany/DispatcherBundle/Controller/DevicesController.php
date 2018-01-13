<?php

namespace MagnetosCompany\DispatcherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevicesController extends Controller
{
    public function dispatcherAction()
    {
        return $this->render('@Dispatcher/main.html.twig');
    }
}
