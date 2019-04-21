<?php declare(strict_types=1);

namespace App\Controller\GUI;


use App\Entity\Infrastructure\Route;
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
     * @GET("/route/{kbs}", requirements={"kbs"="\d+"}, name="gui__route_route")
     * @param Route|null $route
     * @return Response
     */
    public function route(Route $route = null): Response
    {
        if (!$route instanceof Route) {
            //handle
        }
        return $this->render('base.html.twig', [
            'route' => $route,
        ]);
    }

    /**
     * @GET("/route/list", name="gui__route_list")
     */
    public function routeList(): Response
    {

        $routes = $this->entityManager->getRepository(Route::class)->findAll();
        return $this->render('route/routelist.html.twig', [
            'routes' => $routes,
        ]);
    }
}