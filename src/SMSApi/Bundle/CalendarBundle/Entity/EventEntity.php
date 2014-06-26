<?php

namespace SMSApi\Bundle\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SMSApi\Common\ModelBundle\Repository\BaseDoctrineEntityRepository")
 * @ORM\Table(name="event")
 */
class EventEntity {
	
	/** 
	 * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
	 */
	protected $id;

	/** 
	 * @ORM\Column(type="string") 
	 */
	protected $eventName;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $dateStart;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $dateStop;

    /**
     * Set id
     *
     * @param integer $id
     * @return EventEntity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     * @return EventEntity
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string 
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return EventEntity
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateStop
     *
     * @param \DateTime $dateStop
     * @return EventEntity
     */
    public function setDateStop($dateStop)
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    /**
     * Get dateStop
     *
     * @return \DateTime 
     */
    public function getDateStop()
    {
        return $this->dateStop;
    }
}
