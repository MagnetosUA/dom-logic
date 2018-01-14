<?php

namespace MagnetosCompany\DispatcherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevicesController extends Controller
{
    public function devicesAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'devices',
        ]);
    }

    public function interfacesAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
        ]);
    }
}
