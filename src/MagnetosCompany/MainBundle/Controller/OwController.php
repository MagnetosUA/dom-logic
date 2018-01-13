<?php

namespace MagnetosCompany\MainBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

require_once 'Ownet.php';


//print_r($ow->read("/10.E8C1C9000800/temperature"));
//print_r($ow->presence("/10.E8C1C9000800"));
//print_r($ow->set("/10.E8C1C9000800/temphigh",35)); // any value will be converted to string by fwrite function or socket_write

class OwController extends Controller
{
    public function owsensorAction()
    {
        $ow=new OWNet("tcp://127.0.0.1:4304");
        var_dump($ow);
        echo $ow->presence("/10.E8C1C9000800");
        //print_r($ow->dir("/"));
        return $this->render('MainBundle:Sensors:owsensor.html.twig');
    }
}
