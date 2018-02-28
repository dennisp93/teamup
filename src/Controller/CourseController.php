<?php
namespace App\Controller;

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
        return new Response('Implement me', 300, []);
    }

    /**
     * @param Request $request
     * @Route(name="saveCourse", path="/save")
     * @return Response
     */
    public function saveAction(Request $request)
    {
        return new Response('Implement me', 300, []);
    }

    /**
     * @param Request $request
     * @Route(name="removeCourse", path="/remove")
     * @return Response
     */
    public function removeAction(Request $request)
    {
        return new Response('Implement me', 300, []);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->get('doctrine')->getManager();
    }
}