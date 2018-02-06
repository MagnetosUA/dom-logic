<?php

namespace MagnetosCompany\MainBundle\Controller;

use MagnetosCompany\MainBundle\Entity\Device;
use MagnetosCompany\MainBundle\Repository\DeviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MagnetosCompany\MainBundle\Controller\OWNet;


class AjaxController extends Controller
{
    public function setActivatorAction(Request $request)
    {
        if($request->request->get('ask')){                   // Get confirmation that we send ajax request
            //$status = $request->request->get('status');      // Get current status of activato
            $ow = new OWNet('tcp://127.0.0.1:4304');


            $em = $this->getDoctrine()->getManager();
            $device = $em->getRepository(Device::class)->find(3);
            // Update the status in database
            $status = $device->getStatus();
            print_r($status);
            if ($status == '1') {
                $status = '0';
                $ow->set("/12.C2F73D000000/PIO.BYTE", 0);
            } else {
                $status = '1';
                $ow->set("/12.C2F73D000000/PIO.BYTE", 1);
            }
            $device->setStatus($status);
            $em->flush();
            return new Response();
        }

        return $this->render('@Main/Default/rooms.html.twig');
    }
}
