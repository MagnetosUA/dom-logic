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

            $activatorName = $request->request->get('ask');
            $em = $this->getDoctrine()->getManager();
            $id = $em->getRepository(Device::class)->findByName($activatorName)->getResult();
            $id = $id[0]['id'];
            $activator = $em->getRepository(Device::class)->find($id);
            // Update the status in database
            $status = $activator->getStatus();
            $id = $activator->getPersonalId();
            if ($status == '1') {
                $status = '0';
                $ow->set($id."/PIO.BYTE", 0);
            } else {
                $status = '1';
                $ow->set($id."/PIO.BYTE", 1);
            }
            $activator->setStatus($status);
            $em->flush();
            return new Response();
        }

        //return $this->render('@Main/Default/rooms.html.twig');
    }
}
