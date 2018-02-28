<?php
namespace App\Controller;

use App\Entity\Course;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @author Dennis Paulig
 * @Route(path="/api/course", methods={"POST"})
 */
class CourseController extends Controller
{
    /**
     * @param Request $request
     * @Route(name="getCourses", path="/get")
     * @return Response
     */
    public function getAction(Request $request)
    {
        $uid = $request->get('user_id');
        $manager = $this->getDoctrineManager();

        $user = $manager->getRepository('App:User')->find($uid);

        if ($user === null) {
           return new JsonResponse("{'error':'user not found'}", 200, [], true);
        }

        /** @var ArrayCollection $courses */
        $courses = $user->getCourses();

        if ($courses->count() === 0) {
            return new JsonResponse("{'error':'no courses found'}", 200, [], true);
        }

        return new JsonResponse("{'course':'" . $courses[0]->getName() . "'}", 200, [], true);
    }

    /**
     * @param Request $request
     * @Route(name="addCourse", path="/add")
     * @return Response
     */
    public function addAction(Request $request)
    {
        $course = new Course();
        $course->setName($request->get('course_name'));

        $manager = $this->getDoctrineManager();
        $manager->persist($course);
        $manager->flush();

        return new JsonResponse("{'course':'" . $course->getName() . " was added.'}", 200, [], true);
    }

    /**
     * @param Request $request
     * @Route(name="saveCourse", path="/save")
     * @return Response
     */
    public function saveAction(Request $request)
    {
        $manager = $this->getDoctrineManager();
        $course = $manager->getRepository('App:Course')->find($request->get('course_id'));

        if ($course === null) {
            return new JsonResponse("{'error':'course not found'}", 200, [], true);
        }

        $course->setName($request->get('course_name'));
        $manager->flush();

        return new JsonResponse("{'course':'" . $course->getName() . " was saved.'}", 200, [], true);
    }

    /**
     * @param Request $request
     * @Route(name="removeCourse", path="/remove")
     * @return Response
     */
    public function removeAction(Request $request)
    {
        $manager = $this->getDoctrineManager();
        $course = $manager->getRepository('App:Course')->find($request->get('course_id'));

        if ($course === null) {
            return new JsonResponse("{'error':'course not found'}", 200, [], true);
        }

        $manager->remove($course);
        $manager->flush();

        return new JsonResponse("{'course':'" . $course->getName() . " was removed.'}", 200, [], true);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->get('doctrine')->getManager();
    }
}