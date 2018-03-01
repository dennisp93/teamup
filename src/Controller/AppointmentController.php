<?php
namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Course;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @author Dennis Paulig
 * @Route(path="/api/appointment", methods={"POST"})
 */
class AppointmentController extends Controller
{
    /**
     * @param Request $request
     * @Route(name="getAppointments", path="/get")
     * @return JsonResponse
     */
    public function getAction(Request $request)
    {
        $cid = $request->get('course_id');
        $manager = $this->getDoctrineManager();

        $course = $manager->getRepository('App:Course')->find($cid);

        if ($course === null) {
           return new JsonResponse("{'error':'course not found'}", 200, [], true);
        }

        /** @var ArrayCollection $appointments */
        $appointments = $course->getAppointments();

        if ($appointments->count() === 0) {
            return new JsonResponse("{'error':'no appointments found'}", 200, [], true);
        }

        return new JsonResponse("{'appointments':'" . $appointments->count() . " found'}", 200, [], true);
    }

    /**
     * @param Request $request
     * @Route(name="addAppointment", path="/add")
     * @return JsonResponse
     */
    public function addAction(Request $request)
    {
        $appointment = new Appointment();
        $appointment->setType($request->get('appointment_type'));
        $appointment->setTiming($request->get('appointment_timing'));
        $appointment->setLocation($request->get('appointment_location'));

        $cid = $request->get('course_id');
        $manager = $this->getDoctrineManager();

        $course = $manager->getRepository('App:Course')->find($cid);

        if ($course === null) {
            return new JsonResponse("{'error':'course not found'}", 200, [], true);
        }

        $course->addAppointment($appointment);

        $manager->persist($appointment);
        $manager->flush();

        return new JsonResponse("{'appointment':'" . $appointment->getType() . " was added to " . $course->getName() ."'}", 200, [], true);
    }

    /**
     * @param Request $request
     * @Route(name="saveAppointment", path="/save")
     * @return JsonResponse
     */
    public function saveAction(Request $request)
    {
        $manager = $this->getDoctrineManager();
        $appointment = $manager->getRepository('App:Appointment')->find($request->get('appointment_id'));

        if ($appointment === null) {
            return new JsonResponse("{'error':'appointment not found'}", 200, [], true);
        }

        $appointment->setType($request->get('appointment_type'));
        $appointment->setTiming($request->get('appointment_timing'));
        $appointment->setLocation($request->get('appointment_location'));
        $manager->flush();

        return new JsonResponse("{'appointment':'" . $appointment->getType() . " was saved.'}", 200, [], true);
    }

    /**
     * @param Request $request
     * @Route(name="removeAppointment", path="/remove")
     * @return JsonResponse
     */
    public function removeAction(Request $request)
    {
        $manager = $this->getDoctrineManager();
        $appointment = $manager->getRepository('App:Appointment')->find($request->get('appointment_id'));

        if ($appointment === null) {
            return new JsonResponse("{'error':'appointment not found'}", 200, [], true);
        }

        $manager->remove($appointment);
        $manager->flush();

        return new JsonResponse("{'appointment':'" . $appointment->getType() . " was removed.'}", 200, [], true);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->get('doctrine')->getManager();
    }
}