<?php

namespace MagnetosCompany\DispatcherBundle\Controller;

use MagnetosCompany\MainBundle\Controller\OWNet;
use MagnetosCompany\MainBundle\Entity\Device;
use MagnetosCompany\MainBundle\Form\Type\DeviceType;
use MagnetosCompany\MainBundle\Form\Type\RedactorDeviceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MagnetosCompany\MainBundle\Entity\Activator;
use MagnetosCompany\MainBundle\Entity\Sensor;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $sensors = $this->getDoctrine()->getRepository(Device::class)->findSensors()->getResult();
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'devices',
            'sensors' => $sensors,
        ]);
    }

    public function activatorsAction()
    {
        $activators = $this->getDoctrine()->getRepository(Device::class)->findActivators()->getResult();
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'devices',
            'activators' => $activators,
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
        $onewire = $this->getDoctrine()->getRepository(Device::class)->findOnewires()->getResult();
        $em = $this->getDoctrine()->getManager();
        $sensors = $this->getDoctrine()
            ->getRepository('MainBundle:Sensor')
            ->findAll();

        $activators = $this->getDoctrine()
            ->getRepository('MainBundle:Activator')
            ->findAll();

        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'onewire' => $onewire,
            'sensors' => $sensors,
            'activators' => $activators,
        ]);
    }

    public function wifiAction()
    {
        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'wifi' => true,
        ]);
    }


    public function scanningAction(Request $request)
    {
        $form = $this->createForm(DeviceType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var Device $device */
            $device = $form->getData();
            $device->setStatus('1');
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();
        }

        try {
           $ow = new OWNet("tcp://127.0.0.1:4304");
           $devices = $ow->dir("/");
           $device = explode(',', $devices['data']);
        } catch (\ErrorException $e) {
            return $this->render('@Dispatcher/Default/device_manager.html.twig', [
                'thing' => 'interfaces',
                'device_error' => 'Устройств не обнаружено !',
                'onewire' => true,
                'scanning' => true,
                'form' => $form->createView(),
        ]);
        }


        $sensors = [];
        $activators =[];
        foreach ($device as $item) {
            if (preg_match("/^\/28/",$item)) {
                $sensors[] = $item;
            } elseif (preg_match("/^\/12/",$item)) {
                $activators[] = $item;
            }
        }

        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'onewire' => true,
            'scanning' => true,
            'sensors' => $sensors,
            'activators' => $activators,
            'form' => $form->createView(),
        ]);
    }

    public function deviceWidgetAction(Request $request, $deviceId)
    {
        $device = $this->getDoctrine()->getRepository(Device::class)->find($deviceId);
        $form = $this->createForm(RedactorDeviceType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var Device $device */
            $new_device = $form->getData();
            $device->setName($new_device->getName());
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();
        }
        return $this->render('@Dispatcher/Default/device_widget.html.twig', [
            'device' => $device,
            'form' => $form->createView(),
            'thing' => 'devices',
        ]);
    }

    public function deviceDeleteAction($deviceId)
    {
        $device = $this->getDoctrine()->getRepository(Device::class)->find($deviceId);
        $em = $this->getDoctrine()->getManager();
        $em->remove($device);
        $em->flush();
        return $this->redirectToRoute('dispatcher_devices');
    }

    public function expAction()
    {
        $process = new Process('something-with-variable-runtime');
        $process->setTimeout(3600);
        $process->setIdleTimeout(60);
        $process->run();
        return $this->render('@Dispatcher/Default/exp.html.twig');
    }
}
