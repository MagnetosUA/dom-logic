<?php

namespace MagnetosCompany\DispatcherBundle\Controller;

use MagnetosCompany\MainBundle\Controller\OWNet;
use MagnetosCompany\MainBundle\Entity\Device;
use MagnetosCompany\MainBundle\Form\Type\DeviceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MagnetosCompany\MainBundle\Entity\Activator;
use MagnetosCompany\MainBundle\Entity\Sensor;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\Request;

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
        $em = $this->getDoctrine()->getManager();
        $sensors = $this->getDoctrine()
            ->getRepository('MainBundle:Sensor')
            ->findAll();

        $activators = $this->getDoctrine()
            ->getRepository('MainBundle:Activator')
            ->findAll();

        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'onewire' => true,
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
        //$em = $this->getDoctrine()->getManager();
//$ow = new OWNet("tcp://127.0.0.1:4304");
           //$devices = $ow->dir("/");
           //print_r($devices);
        $form = $this->createForm(DeviceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Device $device */
            $device = $form->getData();
            $device->setStatus('1');
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();

            print_r($device);
            //return $this->redirectToRoute('dispatcher_scanning');
        }

        try {
           $ow = new OWNet("tcp://127.0.0.1:4304");
           $devices = $ow->dir("/");
           //print_r($devices);
        } catch (\ErrorException $e) {
            return $this->render('@Dispatcher/Default/device_manager.html.twig', [
                'thing' => 'interfaces',
                'device_error' => 'Устройств не обнаружено !',
                'onewire' => true,
                'scanning' => true,
                'form' => $form->createView(),
        ]);
        }

//        $sensors = $this->getDoctrine()
//            ->getRepository('MainBundle:Sensor')
//            ->findAll();
//
//        $activators = $this->getDoctrine()
//            ->getRepository('MainBundle:Activator')
//            ->findAll();
//
//        for ($i = 0; $i < count($sensors); $i++) {
//            $em->remove($sensors[$i]);
//        }
//        for ($i = 0; $i < count($activators); $i++) {
//            $em->remove($activators[$i]);
//        }
//
//        $em->flush();




        $device = explode(',', $devices['data']);
        $sensors = [];
        $activators =[];
        foreach ($device as $item) {
            if (preg_match("/^\/28/",$item)) {
                $sensors[] = $item;
                //echo $item;
            } elseif (preg_match("/^\/12/",$item)) {
                $activators[] = $item;
            }
        }


        //$ow->setTimeout(1);
        //print_r($ow->read("/28.FFC85AC11604/temperature"));
        //$ow->set("/12.C2F73D000000/PIO.BYTE", 1);


//        for ($i = 0; $i < count($activators); $i++) {
//            $activator = new Activator();
//            $activator->setName('Activator'.$i);
//            $activator->setInterface('1wire');
//            $activator->setStatus('0');
//            $activator->setPersonalId($activators[$i]);
//            $em->persist($activator);
//        }
//
//        for ($i = 0; $i < count($sensors); $i++) {
//            $sensor = new Sensor();
//            $sensor->setName('Sensor'.$i);
//            $sensor->setInterface('1wire');
//            $sensor->setStatus('0');
//            $sensor->setPersonalId($sensors[$i]);
//            $em->persist($sensor);
//        }
//        $em->flush();
//
//        $sensors = $this->getDoctrine()
//            ->getRepository('MainBundle:Sensor')
//            ->findAll();
//
//        $activators = $this->getDoctrine()
//            ->getRepository('MainBundle:Activator')
//            ->findAll();

        return $this->render('@Dispatcher/Default/device_manager.html.twig', [
            'thing' => 'interfaces',
            'onewire' => true,
            'scanning' => true,
            'sensors' => $sensors,
            'activators' => $activators,
            'form' => $form->createView(),
        ]);
    }

    public function expAction()
    {
        return $this->render('@Dispatcher/Default/exp.html.twig');
    }
}
