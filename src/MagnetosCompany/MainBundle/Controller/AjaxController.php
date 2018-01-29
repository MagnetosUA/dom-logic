<?php

namespace MagnetosCompany\MainBundle\Controller;

use MagnetosCompany\MainBundle\Entity\Device;
use MagnetosCompany\MainBundle\Repository\DeviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AjaxController extends Controller
{
    public function setActivatorAction(Request $request)
    {
        if($request->request->get('ask')){
            $status = $request->request->get('status');
            //($status == '1') ? $status = 0:$status = 1;

            ($status == '1')?$status = '0':$status = '1';
            $em = $this->getDoctrine()->getManager();
            $device = $em->getRepository(Device::class)->find(2);
            $device->setStatus($status);
            $em->flush();
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'here the result which will appear in div'];
            return new Response($arrData['output']);
        }

        return $this->render('@Main/Default/rooms.html.twig');
    }
}
