<?php

namespace MagnetosCompany\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activator
 *
 * @ORM\Table(name="activator")
 * @ORM\Entity(repositoryClass="MagnetosCompany\MainBundle\Repository\ActivatorRepository")
 */
class Activator
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
     * @ORM\Column(name="personalId", type="string", length=255, unique=true)
     */
    private $personalId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="interface", type="string", length=255)
     */
    private $interface;


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
     * @return Activator
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
     * Set personalId
     *
     * @param string $personalId
     *
     * @return Activator
     */
    public function setPersonalId($personalId)
    {
        $this->personalId = $personalId;

        return $this;
    }

    /**
     * Get personalId
     *
     * @return string
     */
    public function getPersonalId()
    {
        return $this->personalId;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Activator
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set interface
     *
     * @param string $interface
     *
     * @return Activator
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;

        return $this;
    }

    /**
     * Get interface
     *
     * @return string
     */
    public function getInterface()
    {
        return $this->interface;
    }
}

