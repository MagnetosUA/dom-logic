<?php

namespace MagnetosCompany\MainBundle\Controller;

use MagnetosCompany\MainBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use MagnetosCompany\MainBundle\Entity\Room;
use MagnetosCompany\MainBundle\Entity\Device;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use MagnetosCompany\MainBundle\Form\Type\DeviceType;

class DefaultController extends Controller
{
    public function homeAction()
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $widget = $this->getDoctrine()
            ->getRepository('MainBundle:Widget')
            ->find(1);
        return $this->render('MainBundle:Default:home.html.twig', [
            'task' => $task,
            'widget' => $widget,
        ]);
    }

    public function roomsAction()
    {
        $room = $this->getDoctrine()
            ->getRepository('MainBundle:Room')
            ->findAll();
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        return $this->render('MainBundle:Default:rooms.html.twig', [
            'room' =>  $room,
            'task' => $task,
        ]);
    }

    public function devicemanagerAction()
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $device = $this->getDoctrine()
            ->getRepository('MainBundle:Device')
            ->findAll();
        return $this->render('MainBundle:Default:device_manager.html.twig', [
            'device' =>  $device,
            'task' => $task,
        ]);
    }

    public function settingsAction()
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        return $this->render('MainBundle:Default:settings.html.twig', [
            'task' => $task,
        ]);
    }

    public function addroomAction(Request $request)
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $device = $this->getDoctrine()
            ->getRepository('MainBundle:Device')
            ->findAll();
        return $this->render('MainBundle:Default:addroom.html.twig', [
            'task' => $task,
            'device' => $device,
        ]);
    }

    public function succesroomAction(Request $request)
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $request = Request::createFromGlobals();
        $name = $request->query->get('name');
        $device = $request->query->get('device');
        $sensor = $request->query->get('sensor');
        $linkToImage = $request->query->get('link_to_image');
        $room = new Room();
        $room->setName($name);
        $room->setDevice($device);
        $room->setSensor($sensor);
        $room->setLinkToImage($linkToImage);
        $em = $this->getDoctrine()->getManager();
        $em->persist($room);
        $em->flush();
        return $this->render('MainBundle:Default:success.html.twig', [
            'name' => $name,
            'thing' => 'room',
            'task' => $task,
        ]);
    }

    public function adddeviceAction()
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        return $this->render('MainBundle:Default:adddevice.html.twig', [
            'task' => $task,
        ]);
    }

    public function succesdeviceAction(Request $request)
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $request = Request::createFromGlobals();
        $name = $request->query->get('name');
        $type = $request->query->get('type');
        $personalId = $request->query->get('personal_id');
        $status = $request->query->get('status');
        $device = new Device();
        $device->setName($name);
        $device->setType($type);
        $device->setPersonalId($personalId);
        $device->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $em->persist($device);
        $em->flush();
        return $this->render('MainBundle:Default:success.html.twig', [
            'thing' => 'device',
            'name' => $name,
            'task' => $task,
        ]);
    }

    public function addtaskAction(Request $request)
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $request = Request::createFromGlobals();

        if ($request->query->get('content')){
            $content = $request->query->get('content');
            $task = new Task();
            $task->setTask($content);
            $task->setStatus('1');
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->render('MainBundle:Default:success.html.twig', [
                'thing' => 'task',
                'name' => $content,
                'task' => $task,
            ]);
        } else {
            return $this->render('MainBundle:Default:addtask.html.twig', [
                'task' => $task,
            ]);
        }

    }

    public function deleteTaskAction(Request $request)
    {
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        $request = Request::createFromGlobals();
        $url = $request->getLocale();
        var_dump($url);
        $name = $request->query->all();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('MainBundle:Task');
        foreach ($name as $item=>$value){
            //echo $item."=".$value;
            if ($value == 'on'){
                $task = $repository->find($item);
                $em->remove($task);
                $em->flush();
            }
        }
        return $this->redirect('/');
    }

    public function widgetsAction(Request $request)
    {
        $request = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('MainBundle:Widget');
        if ($request->query->get('submit')) {
            $name = $request->query->get('weather');
            $widget = $repository->find(1);
            if ($name == 'on'){
                $widget->setStatus(1);
                $em->persist($widget);
                $em->flush();
            } else {
                $widget->setStatus(0);
                $em->persist($widget);
                $em->flush();
            }
        }
        $widget = $repository->find(1);
        $task = $this->getDoctrine()
            ->getRepository('MainBundle:Task')
            ->findAll();
        return $this->render('MainBundle:Default:widgets.html.twig', [
            'task' => $task,
            'widget' => $widget,
        ]);
    }

    public function coolAction()
    {
        return $this->render('MainBundle:Default:cool.html.twig');
    }

    public function registerAction(Request $request)
    {
        $form = $this->createForm(DeviceType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var Device $device */
            $device = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($device);
            $em->flush();

            return $this->redirectToRoute('dispatcher_scanning');
        }
    }


}
