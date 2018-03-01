<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
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
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="courses")
     */
    private $users;

    /**
     * @var ArrayCollection(Appointment)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Appointment", mappedBy="course")
     */
    private $appointments;

    /**
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->appointments = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $user
     */
    public function addUser($user)
    {
        $this->users->add($user);
        $user->addCourse($this);
    }

    /**
     * @param User $user
     */
    public function removeUser($user)
    {
        $this->users->remove($user);
        $user->removeCourse($this);
    }

    /**
     * @return ArrayCollection
     */
    public function getAppointments()
    {
        return $this->appointments;
    }


    /**
     * @param Appointment $appointment
     */
    public function addAppointment($appointment)
    {
        $this->appointments->add($appointment);
        $appointment->setCourse($this);
    }

    /**
     * @param Appointment $appointment
     */
    public function removeAppointment($appointment)
    {
        $this->appointments->remove($appointment);
        $appointment->setCourse(null);
    }
}
