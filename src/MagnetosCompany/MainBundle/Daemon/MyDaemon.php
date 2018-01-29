<?php

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

include 'OWNet.php';

//$devices = $ow->dir("/");
//echo $ow->read("/28.FFC85AC11604/temperature");
class MyDaemon extends Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    public function initSensors()
    {
        $ow = new \MagnetosCompany\MainBundle\Daemon\OWNet("tcp://127.0.0.1:4304");
    }

    public function startAsk()
    {
        $sensors = $this->getDoctrine()->getRepository('MainBundle:Sensor')->findAll();
        for ($s = 0; $s <= count($sensors); $s++) {
            echo $s->getId();
        }
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
    }
}

$daemon = new MyDaemon();
$daemon->startAsk();

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