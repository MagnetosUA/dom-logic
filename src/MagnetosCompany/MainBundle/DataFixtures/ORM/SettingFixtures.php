<?php

namespace MagnetosCompany\MainBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MagnetosCompany\MainBundle\Entity\Setting;

class SettingFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $setting = new Setting();
        $setting->setTime(0);
        $setting->setStatus(0);

        $manager->persist($setting);
        $manager->flush();
    }
}