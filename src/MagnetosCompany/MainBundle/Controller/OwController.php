<?php

namespace MagnetosCompany\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MagnetosCompany\MainBundle\Controller\OWNet;
use MagnetosCompany\MainBundle\Entity\Activator;
use MagnetosCompany\MainBundle\Entity\Sensor;

class OwController extends Controller
{
    public function owsensorAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ow = new OWNet("tcp://127.0.0.1:4304");

        if ($ow->dir("/")) {
            $devices = $ow->dir("/");
        }
        else return;

        $device = explode(',', $devices['data']);
        $sensors = [];
        $activators =[];
        foreach ($device as $item) {
            //echo $item."<br>";
            if (preg_match("/^\/28/",$item)) {
                $sensors[] = $item;
                //echo $item."<br>";
            } elseif (preg_match("/^\/12/",$item)) {
                $activators[] = $item;
            }
        }

        //$ow->setTimeout(1);
        //print_r($ow->read("/28.FFC85AC11604/temperature"));
        //$ow->set("/12.C2F73D000000/PIO.BYTE", 1);
        for ($i = 0; $i < count($activators); $i++) {
            $activator = new Activator();
            $activator->setName('Activator'.$i);
            $activator->setInterface('1wire');
            $activator->setStatus('0');
            $activator->setPersonalId($activators[$i]);
            $em->persist($activator);
        }

        for ($i = 0; $i < count($sensors); $i++) {
            $sensor = new Sensor();
            $sensor->setName('Sensor'.$i);
            $sensor->setInterface('1wire');
            $sensor->setStatus('0');
            $sensor->setPersonalId($sensors[$i]);
            $em->persist($sensor);
        }

        $em->flush();

        return $this->render('MainBundle:Sensors:owsensor.html.twig', [
            'ow' => $ow,
        ]);
    }
}
