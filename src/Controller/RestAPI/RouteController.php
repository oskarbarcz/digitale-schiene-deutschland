<?php declare(strict_types=1);

namespace App\Controller\RestAPI;

use App\Entity\Infrastructure\Route;
use App\Exceptions\NotFound\RouteNotFoundException as NotFound;
use App\Services\EntityServices\RouteService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * TrackObjectController
 *
 * @package App\Controller\RestAPI
 */
class RouteController extends AbstractController
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var SerializerInterface */
    protected $serializer;

    /** @var ValidatorInterface */
    protected $validator;
    /** @var RouteService */
    protected $routeService;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        RouteService $routeService
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->routeService = $routeService;
    }

    /**
     * Returns route by it's KBS
     *
     * @SWG\Tag(name="Route")
     * @SWG\Response(
     *     response="200",
     *     description="Returns route by it's KBS",
     *     @Model(type=Route::class)
     * )
     * @SWG\Parameter(
     *     name="kbs",
     *     in="path",
     *     type="integer",
     *     description="Kursbuchstrecke - German Railways unique line number"
     * )
     * @Rest\View()
     * @Rest\Get("/api/route/{kbs}", name="api__route_get-one")
     * @param int $kbs Kursbuchstrecke - line number in English, line identifer
     * @return View
     * @throws NotFound
     */
    public function getOne(int $kbs): View
    {
        $route = $this->routeService->get($kbs);
        return View::create($route);
    }

    /**
     * Returns all routes from database
     *
     * @SWG\Tag(name="Route")
     * @SWG\Response(
     *     response="200",
     *     description="Returns all routes from database",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Route"))
     * )
     * @Rest\View()
     * @Rest\Get("/api/route/all", name="api__route_get-all")
     * @return View
     */
    public function getAll(): View
    {
        $routes = $this->routeService->getAll();
        return View::create($routes);
    }
}

