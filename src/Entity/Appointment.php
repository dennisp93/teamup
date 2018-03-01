<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppointmentRepository")
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\Column(type="string")
     */
    private $timing;

    /**
     * @ORM\Column(type="string")
     */
    private $location;

    /**
     * @var Course
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="appointments")
     * @JoinColumn(name="course_id", referencedColumnName="id")
     */
    private $course;

    /**
     * @var ArrayCollection(Appointment)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Participation", mappedBy="appointment")
     */
    private $participation;

    public function __construct()
    {
        $this->participation = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTiming()
    {
        return $this->timing;
    }

    /**
     * @param mixed $timing
     */
    public function setTiming($timing)
    {
        $this->timing = $timing;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param Course $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    /**
     * @return ArrayCollection
     */
    public function getParticipation()
    {
        return $this->participation;
    }

    /**
     * @param Participation $participation
     */
    public function addParticipation($participation)
    {
        $this->participation->add($participation);
        $participation->setAppointment($this);
    }

    /**
     * @param Participation $participation
     */
    public function removeParticipation($participation)
    {
        $this->participation->remove($participation);
        $participation->setAppointment(null);
    }
}
