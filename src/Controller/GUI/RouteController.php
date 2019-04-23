<?php declare(strict_types=1);

namespace App\Controller\GUI;


use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as GET;

/**
 * RouteController
 *
 * @package App\Controller\GUI
 */
class RouteController extends AbstractController
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * Assigns data from arguments as class fields
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @GET("/route/{kbs}", requirements={"kbs"="\d+"}, name="gui__route_details")
     * @param Route|null $route
     * @return Response
     */
    public function routeDetails(Route $route = null): Response
    {
        // handle not founding the route
        if (!$route instanceof Route) {
            return $this->redirectToRoute('gui__route_list');
        }

        // sort the stations along the way
        $stations = [];
        foreach ($route->getTrackObjects() as $object) {
            $station = $object->getStation();
            if ($station instanceof Station) {
                $stations[] = $station;
            }
        }

        return $this->render('route/route_details.html.twig', [
            'route'    => $route,
            'stations' => $stations,
        ]);
    }

    /**
     * @GET("/route/list", name="gui__route_list")
     */
    public function routeChooseScreen(): Response
    {

        $routes = $this->entityManager->getRepository(Route::class)->findAll();
        return $this->render('route/route_choose.html.twig', [
            'routes' => $routes,
        ]);
    }
}
