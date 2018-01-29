<?php

namespace MagnetosCompany\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MagnetosCompany\MainBundle\Daemon\OWNet;
use MagnetosCompany\MainBundle\Entity\Sensor;

class DaemonController extends Controller
{
    public function startAction()
    {
        //$ow = new OWNet("tcp://127.0.0.1:4304");
        $devices = $this->getDoctrine()->getRepository('MainBundle:Device')->findDevices()->getResult();
        //echo $devices[0]['personalId'];
        //print_r($devices);
//        for ($s = 0; $s < count($sensors); $s++) {
//            //print_r($sensors[$s]);
//            print_r($sensors[0]);
//        }
//            foreach ($sensors as $s) {
//                print_r($s);
//                echo "<br/>1";
//            }
        //print_r($sensors[0]);
        $ow = new \MagnetosCompany\MainBundle\Daemon\OWNet("tcp://127.0.0.1:4304");
        //echo $ow->read($devices[0]['personalId']."/temperature");
        for ($i = 0; $i < 5; $i++) {
            echo $ow->read($devices[0]['personalId']."/temperature");
            usleep(3000000);
            $i++;
        }
//        $i = 0;
//                while ($i<5) {
//            echo '*';
//            //$ow->read("/28.FFC85AC11604/temperature");
//            echo $ow->read($devices[0]['personalId']."/temperature");
//            usleep(3000000);
//            $i++;
//        }
        return $this->render('@Main/Sensors/owsensor.html.twig', [
            'devices' => $devices,
        ]);
    }
}


//$devices = $ow->dir("/");
//echo $ow->read("/28.FFC85AC11604/temperature");

//        $ow = new \MagnetosCompany\MainBundle\Daemon\OWNet("tcp://127.0.0.1:4304");
//        $i = 0;
//        while (1) {
//            echo '*';
//            $ow->read("/28.FFC85AC11604/temperature");
//            echo $ow->read("/28.FFC85AC11604/temperature");
//            usleep(6*1000000);
//            $i++;
//            if ($i%10==0) {
//                echo "Yet $i minutes !";
//            }
//        }



//function scan()
//{
//    $ow = new ow("tcp://127.0.0.1:4304");
//    try {
//
//        $devices = $ow->dir("/");
//        //print_r($devices);
//    } catch (\ErrorException $e) {
//        return false;
//    }
//}



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


//$ow->setTimeout(1);
//echo $ow->read("/28.FFC85AC11604/temperature");
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




//scan();
//
//