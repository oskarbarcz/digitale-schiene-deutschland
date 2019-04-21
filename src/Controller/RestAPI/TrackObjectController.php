<?php declare(strict_types=1);

namespace App\Controller\RestAPI;

use App\Controller\Abstracts\AbstractValidatorFOSRestController;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\TrackObject;
use App\Exceptions\NotFound\RouteNotFoundException;
use App\Exceptions\NotFound\TrackObjectNotFoundException;
use App\Exceptions\NotFound\TrackObjectTypeNotFoundException;
use App\Services\EntityServices\RouteService;
use App\Services\EntityServices\TrackObjectService;
use App\Services\EntityServices\TrackObjectTypeService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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
    /** @var SerializerInterface */
    protected $serializer;
    /** @var TrackObjectTypeService */
    protected $trackObjectTypeService;

    /**
     * Assigns data from arguments as class fields
     *
     * @param ValidatorInterface     $validator
     * @param TrackObjectService     $trackObjectService
     * @param RouteService           $routeService
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface    $serializer
     * @param TrackObjectTypeService $trackObjectTypeService
     */
    public function __construct(
        ValidatorInterface $validator,
        TrackObjectService $trackObjectService,
        RouteService $routeService,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        TrackObjectTypeService $trackObjectTypeService
    ) {
        parent::__construct($validator);
        $this->trackObjectService = $trackObjectService;
        $this->routeService = $routeService;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->trackObjectTypeService = $trackObjectTypeService;
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
     * @SWG\Response(
     *     response="204",
     *     description="No track objects exist in database"
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
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Object unique identifier",
     *     type="integer",
     *     required=true
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
     * @SWG\Response(
     *     response="204",
     *     description="No track objects linked to this route"
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Route does not exist"
     * )
     * @SWG\Parameter(
     *     name="kbs",
     *     in="path",
     *     description="Kursbuchstrecke - German Railways unique line number",
     *     type="integer",
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Get("/byRoute/{kbs}", requirements={"kbs"="\d+"}, name="api__track-object_by-route")
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
     * @SWG\Response(response="400", description="At least one of entered values has incorrect format.")
     * @SWG\Parameter(
     *     description="Object to add. Remember that you don't need to add full relation objects, type ID and route KBS
    will be enough.", name="TrackObject", in="body", type="object",
     *     @SWG\Schema(ref="#/definitions/TrackObject"),
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Post("", name="api__track-object_add")
     * @param Request $request
     * @return View
     * @throws RouteNotFoundException
     * @throws TrackObjectTypeNotFoundException
     */
    public function add(Request $request): View
    {
        /** @var TrackObject $trackObject */
        $trackObject = $this->serializer->deserialize($request->getContent(), TrackObject::class, 'json');

        if (empty($trackObject->getRoute() && $trackObject->getType())) {
            throw new BadRequestHttpException();
        }

        // get from raw request
        $route = $this->routeService->get($trackObject->getRoute()->getKbs());
        $type = $this->trackObjectTypeService->get($trackObject->getType()->getId());

        // set them
        $trackObject->setRoute($route);
        $trackObject->setType($type);

        // validate object
        $result = $this->validate($trackObject);
        if ($result) {
            return View::create($result, 400);
        }

        $this->entityManager->persist($trackObject);
        $this->entityManager->flush();
        return View::create($trackObject);
    }

    /**
     * Edits a track object
     *
     * @SWG\Tag(name="TrackObject")
     * @SWG\Response(
     *     response="200",
     *     description="Changes saved successfully",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/TrackObject"))
     * )
     * @SWG\Response(
     *     response="400",
     *     description="At least one of entered values has incorrect format."
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Track object with this ID were not found."
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Object unique identifier",
     *     type="integer",
     *     required=true
     * )
     * @SWG\Parameter(
     *     name="TrackObject",
     *     in="body",
     *     description="Object to edit",
     *     type="object",
     *     @SWG\Schema(ref="#/definitions/TrackObject"),
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Patch("/{id}", requirements={"id"="\d+"}, name="app_track-object_edit")
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
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Object unique identifier",
     *     type="integer",
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Delete("/{id}", requirements={"id"="\d+"}, name="api__track-object_delete")
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

