<?php declare(strict_types=1);

namespace App\Controller\GUI;


use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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

    private const ELEMENTS_ON_PAGE = 8;

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
     * Renders route details screen
     *
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
     * Shows screen for route choose
     *
     * @GET("/route/list/{page}", name="gui__route_list")
     * @param PaginatorInterface $paginator
     * @param int                $page
     * @return Response
     */
    public function routeChooseScreen(PaginatorInterface $paginator, int $page = 1): Response
    {
        $dql = 'SELECT a FROM App\Entity\Infrastructure\Route a ORDER BY a.id ASC';
        $query = $this->entityManager->createQuery($dql);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $page,
            self::ELEMENTS_ON_PAGE
        );

        return $this->render('route/route_choose.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
