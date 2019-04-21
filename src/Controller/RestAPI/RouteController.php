<?php declare(strict_types=1);

namespace App\Controller\RestAPI;

use App\Controller\Abstracts\AbstractValidatorFOSRestController;
use App\Entity\Infrastructure\Route;
use App\Exceptions\NotFound\RouteNotFoundException as NotFound;
use App\Services\EntityServices\RouteService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * TrackObjectController
 *
 * @Rest\Route("api/route")
 * @package App\Controller\RestAPI
 */
class RouteController extends AbstractValidatorFOSRestController
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var SerializerInterface */
    protected $serializer;

    /** @var RouteService */
    protected $routeService;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        RouteService $routeService
    ) {
        parent::__construct($validator);
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->routeService = $routeService;
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
     * @SWG\Response(
     *     response="204",
     *     description="There's no routes in database"
     * )
     * @Rest\View()
     * @Rest\Get("/all", name="api__route_get-all")
     * @return View
     */
    public function getAll(): View
    {
        $routes = $this->routeService->getAll();
        return View::create($routes);
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
     * @SWG\Response(
     *     response="404",
     *     description="Route with given KBS wasn't not found, most likely it doesn't exist"
     * )
     * @SWG\Parameter(
     *     name="kbs",
     *     in="path",
     *     type="integer",
     *     description="Kursbuchstrecke - German Railways unique line number"
     * )
     * @Rest\View()
     * @Rest\Get("/{kbs}", name="api__route_get-one")
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
     * @SWG\Response(
     *     response="400",
     *     description="Occures when request does not meet requirements. Contraint violation list is returned.",
     *     @SWG\Schema(
     *      type="array",
     *      @SWG\Items(type="string"),
     *      example={"Name field value is too long. Use shorter name.", "Route with this KBS already exists."}
     *     )
     * )
     * @SWG\Parameter(
     *     name="Route",
     *     in="body",
     *     type="object",
     *     @SWG\Schema(ref="#/definitions/Route"),
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Post("", name="api__route_add")
     * @param Request $request
     * @return View
     */
    public function add(Request $request): View
    {
        // get from request
        $json = $request->getContent();

        /** @var Route $updated */
        $route = $this->serializer->deserialize($json, Route::class, 'json');

        // run validator over entity
        $valid = $this->validate($route);
        if ($valid) {
            return View::create($valid, 400);
        }

        // database operations
        $this->entityManager->persist($route);
        $this->entityManager->flush();

        return View::create($route, 201);
    }

    /**
     * Edits route with given data
     *
     * @SWG\Tag(name="Route")
     * @SWG\Response(
     *     response="200",
     *     description="Successfully edited route.",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Route"))
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Occures when request does not meet requirements. Contraint violation list is returned.",
     *     @SWG\Schema(
     *      type="array",
     *      @SWG\Items(type="string"),
     *      example={"Name field value is too long. Use shorter name.", "Route with this KBS already exists."}
     *     )
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Route with given KBS wasn't not found, most likely it doesn't exist"
     * )
     * @SWG\Parameter(
     *     name="kbs",
     *     in="path",
     *     type="integer",
     *     description="Kursbuchstrecke - German Railways unique line number"
     * )
     * @SWG\Parameter(
     *     name="Route",
     *     in="body",
     *     type="object",
     *     @SWG\Schema(ref="#/definitions/Route"),
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Patch("/{kbs}", name="api__route_edit")
     *
     * @param Request $request
     * @param Route   $oldRoute
     * @return View
     */
    public function edit(Request $request, Route $oldRoute): View
    {
        // get from request
        $json = $request->getContent();

        /** @var Route $updated */
        $updated = $this->serializer->deserialize($json, Route::class, 'json');

        // assign data
        $oldRoute->setName($updated->getName())
                 ->setMaxPermittedSpeed($updated->getMaxPermittedSpeed())
                 ->setStationsName($updated->getStationsName())
                 ->setLength($updated->getLength())
                 ->setKbs($updated->getKbs());

        // run validator over entity
        $valid = $this->validate($oldRoute);
        if ($valid) {
            return View::create($valid, 400);
        }

        // database operations
        $this->entityManager->persist($oldRoute);
        $this->entityManager->flush();

        return View::create($oldRoute);
    }

    /**
     * Deletes whole route from database
     *
     * @SWG\Tag(name="Route")
     * @SWG\Response(
     *     response=204,
     *     description="Route was successfully deleted from database"
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Route with given KBS wasn't not found, most likely it doesn't exist"
     * )
     * @SWG\Parameter(
     *     name="kbs",
     *     in="path",
     *     type="integer",
     *     description="Kursbuchstrecke - German Railways unique line number"
     * )
     * @Rest\View()
     * @Rest\Delete("/{kbs}", name="api__route_delete")
     * @param int $kbs
     * @return View
     * @throws NotFound
     */
    public function delete(int $kbs): View
    {
        $this->routeService->delete($kbs);
        return View::create();
    }
}
