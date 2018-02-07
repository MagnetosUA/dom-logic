<?php

namespace MagnetosCompany\MainBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MagnetosCompany\MainBundle\Entity\Room;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 8; $i++) {
            $p = rand(0, 3);
            $room = new Room();
            $room->setName('Room '.$i);
            $room->setSensor('Sensor '.$i);
            $room->setDevice('Device '.$i);
            $room->setLinkToImage('assets/images/textures/room-fixture'.$p.'.jpg');

            $manager->persist($room);
        }
        $manager->flush();
    }
}