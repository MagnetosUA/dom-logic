<?php

namespace MagnetosCompany\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="MagnetosCompany\MainBundle\Repository\RoomRepository")
 */
class Room
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link_to_image", type="string", length=255, unique=true)
     */
    private $linkToImage;

    /**
     * @var string
     *
     * @ORM\Column(name="device", type="string", length=255)
     */
    private $device;

    /**
     * @var string
     *
     * @ORM\Column(name="sensor", type="string", length=255)
     */
    private $sensor;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set linkToImage
     *
     * @param string $linkToImage
     *
     * @return Room
     */
    public function setLinkToImage($linkToImage)
    {
        $this->linkToImage = $linkToImage;

        return $this;
    }

    /**
     * Get linkToImage
     *
     * @return string
     */
    public function getLinkToImage()
    {
        return $this->linkToImage;
    }

    /**
     * Set device
     *
     * @param string $device
     *
     * @return Room
     */
    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * Get device
     *
     * @return string
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * Set sensor
     *
     * @param string $sensor
     *
     * @return Room
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;

        return $this;
    }

    /**
     * Get sensor
     *
     * @return string
     */
    public function getSensor()
    {
        return $this->sensor;
    }
}

