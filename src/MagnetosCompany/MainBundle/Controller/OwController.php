<?php

namespace MagnetosCompany\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MagnetosCompany\MainBundle\Controller\OWNet;

//require_once 'OWNet.php';


//print_r($ow->read("/10.E8C1C9000800/temperature"));
//print_r($ow->presence("/10.E8C1C9000800"));
//print_r($ow->set("/10.E8C1C9000800/temphigh",35)); // any value will be converted to string by fwrite function or socket_write

class OwController extends Controller
{
    public function owsensorAction()
    {
        $ow=new OWNet("tcp://127.0.0.1:4304");
        //echo $ow->getHost();
        //echo $ow->getTimeout();
        //var_dump($ow->get("/10.E8C1C9000800/temperature",OWNET_MSG_READ,false));
        //var_dump($ow);
        //echo $ow->presence("/28.FFC85AC11604");
       // OWNet::read( "localhost:4304" , "/10.E8C1C9000800/temperature" );
        //print_r($ow->read("28.FFC85AC11604/"));
        //print_r($ow->dir("/28.FFC85AC11604"));
       // print_r($ow->getUseSwigDir());
        //$ow->setTimeout(1);
        print_r($ow->read("/28.FFC85AC11604/temperature"));
        return $this->render('MainBundle:Sensors:owsensor.html.twig');
    }
}
