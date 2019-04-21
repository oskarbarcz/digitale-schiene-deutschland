<?php declare(strict_types=1);

namespace App\Controller\RestAPI;

use App\Controller\Abstracts\AbstractValidatorFOSRestController;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\TrackObject;
use App\Exceptions\NotFound\TrackObjectNotFoundException;
use App\Services\EntityServices\RouteService;
use App\Services\EntityServices\TrackObjectService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * TrackObjectController
 *
 * @Rest\Route("/api/track-object")
 * @package App\Controller\RestAPI
 */
class TrackObjectController extends AbstractValidatorFOSRestController
{
    /** @var TrackObjectService */
    protected $trackObjectService;

    /** @var RouteService */
    protected $routeService;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * Assigns data from arguments as class fields
     *
     * @param ValidatorInterface     $validator
     * @param TrackObjectService     $trackObjectService
     * @param RouteService           $routeService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ValidatorInterface $validator,
        TrackObjectService $trackObjectService,
        RouteService $routeService,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($validator);
        $this->trackObjectService = $trackObjectService;
        $this->routeService = $routeService;
        $this->entityManager = $entityManager;
    }

    /**
     * Gets all track objects from database
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Returned array of all objects in database",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TrackObject"))
     * )
     * @Rest\View()
     * @Rest\Get("/all", name="api__track-object_get-all"))
     */
    public function getAll()
    {
        $objects = $this->trackObjectService->getAll();
        return View::create($objects);
    }

    /**
     * Gets track object by it's ID
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Returning track object with given ID.",
     *     @Model(type=TrackObject::class)
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Track object with given ID not found."
     * )
     * @Rest\View()
     * @Rest\Get("/{id}", requirements={"id"="\d+"}, name="api__track-object_by-id"))
     * @param TrackObject $trackObject
     * @return View
     */
    public function getOne(TrackObject $trackObject): View
    {
        return View::create($trackObject);
    }

    /**
     * Gets all track objects assigned to route
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Returned array of items belonging to a route",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TrackObject"))
     * )
     * @Rest\View()
     * @Rest\Get("/byRoute/{kbs}",requirements={"kbs"="\d+"}, name="api__track-object_by-route")
     * @param Route $route
     * @return View
     */
    public function getForRoute(Route $route): View
    {
        return View::create($route->getTrackObjects());
    }

    /**
     * Adds a track object
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Returned array of items belonging to a route",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TrackObject"))
     * )
     * @Rest\View()
     * @Rest\Post("/", name="api__track-object_add")
     * @param TrackObject $trackObject
     * @return View
     */
    public function add(TrackObject $trackObject): View
    {
        // validate object
        $result = $this->validate($trackObject);
        if ($result) {
            return View::create($result, 400);
        }

        $this->entityManager->persist($trackObject);
        $this->entityManager->flush();
        return View::create();
    }

    /**
     * Edits a track object
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Returned array of items belonging to a route",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TrackObject"))
     * )
     * @Rest\View()
     * @Rest\Patch("/{id}", name="app_track-object_edit")
     */
    public function edit()
    {

    }

    /**
     * Deletes a track object
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Returned array of items belonging to a route",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TrackObject"))
     * )
     * @Rest\View()
     * @Rest\Delete("/{id}", name="api__track-object_delete")
     * @param int $id
     * @return View
     * @throws TrackObjectNotFoundException
     */
    public function delete(int $id): View
    {
        $this->trackObjectService->delete($id);
        return View::create();
    }
}

