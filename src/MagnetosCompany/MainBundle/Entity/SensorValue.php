<?php

namespace MagnetosCompany\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SensorValue
 *
 * @ORM\Table(name="sensor_value")
 * @ORM\Entity(repositoryClass="MagnetosCompany\MainBundle\Repository\SensorValueRepository")
 */
class SensorValue
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
     * @ORM\Column(name="sensor_id", type="string", length=255)
     */
    private $sensorId;

    /**
     * @var string
     *
     * @ORM\Column(name="reading", type="string", length=255)
     */
    private $reading;

    /**
     * @var string
     *
     * @ORM\Column(name="cur_date", type="datetime", length=255)
     */
    private $curDate;


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
     * Set sensorId
     *
     * @param string $sensorId
     *
     * @return SensorValue
     */
    public function setSensorId($sensorId)
    {
        $this->sensorId = $sensorId;

        return $this;
    }

    /**
     * Get sensorId
     *
     * @return string
     */
    public function getSensorId()
    {
        return $this->sensorId;
    }

    /**
     * @return string
     */
    public function getReading()
    {
        return $this->reading;
    }

    /**
     * @param string $reading
     */
    public function setReading($reading)
    {
        $this->reading = $reading;
    }

    /**
     * @return string
     */
    public function getCurDate()
    {
        return $this->curDate;
    }

    /**
     * @param string $curDate
     */
    public function setCurDate($curDate)
    {
        $this->curDate = $curDate;
    }

}

