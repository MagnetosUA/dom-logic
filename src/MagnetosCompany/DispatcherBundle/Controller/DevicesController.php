<?php

namespace MagnetosCompany\DispatcherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevicesController extends Controller
{
    #devices

    public function devicesAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'devices',
        ]);
    }

    public function sensorsAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'devices',
            'sensors' => true,
        ]);
    }

    public function activatorsAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'devices',
            'activators' => true,
        ]);
    }

    #interfaces

    public function interfacesAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
        ]);
    }

    public function onewireAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'onewire' => true,
        ]);
    }

    public function wifiAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'wifi' => true,
        ]);
    }
}
