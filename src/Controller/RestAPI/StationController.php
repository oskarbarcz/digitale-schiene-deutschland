<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use App\Controller\Abstracts\AbstractValidatorFOSRestController;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use App\Entity\Infrastructure\TrackObject;
use App\Exceptions\NotFound\RouteNotFoundException;
use App\Exceptions\NotFound\StationNotFoundException;
use App\Exceptions\NotFound\TrackObjectNotFoundException;
use App\Exceptions\StructureViolation\TrackObjectIsNotAStationException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * StationController
 *
 * @Rest\Route("api/station")
 * @package App\Controller\RestAPI
 */
class StationController extends AbstractValidatorFOSRestController
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * Assigns data from arguments as class fields
     *
     * @param ValidatorInterface     $validator
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        parent::__construct($validator);
        $this->entityManager = $entityManager;
    }

    /**
     * Returns all stations from database
     *
     * @SWG\Tag(name="Station")
     * @SWG\Response(
     *     response="200",
     *     description="All stations in database"
     * )
     * @SWG\Response(
     *     response="204",
     *     description="No stations found in database"
     * )
     * @Rest\View()
     * @Rest\Get("/all", name="api_station_get-all")
     * @return View
     */
    public function getAll(): View
    {
        $stations = $this->entityManager->getRepository(Station::class)->findAll();
        return View::create($stations);
    }

    /**
     * Return station by it's ID
     *
     * @SWG\Tag(name="Station")
     * @SWG\Response(
     *     response="200",
     *     description="Station with given ID",
     *     @Model(type=Station::class)
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Station were not found in database"
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Unique station identifier",
     *     type="integer",
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Get("/{id}", requirements={"id"="\d+"}, name="api__station_get-one")
     * @param Station $station
     * @return View
     * @throws StationNotFoundException
     */
    public function getOne(Station $station = null): View
    {
        if (!$station instanceof Station) {
            throw new StationNotFoundException('station.not-found');
        }
        return View::create($station);
    }

    /**
     * Return stations along given route
     *
     * @SWG\Tag(name="Station")
     * @SWG\Response(
     *     response="200",
     *     description="Stations along the way",
     *     @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Station"))
     * )
     * @SWG\Response(
     *     response="204",
     *     description="Route has no stations along the way"
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Route with given KBS were not found"
     * )
     * @SWG\Parameter(
     *     name="kbs",
     *     in="path",
     *     description="Kursbuchstrecke - German Railway unique line number",
     *     type="integer",
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Get("/by-route/{kbs}", name="api__station_get-by-route")
     * @param Route $route
     * @return View
     * @throws RouteNotFoundException
     */
    public function getByRoute(Route $route = null): View
    {
        if (!$route instanceof Route) {
            throw new RouteNotFoundException('route.not-found');
        }

        // assign stations
        $stations = [];
        foreach ($route->getTrackObjects() as $object) {
            $station = $object->getStation();
            if ($station instanceof Station) {
                $stations[] = $station;
            }
        }

        return View::create($stations);
    }

    /**
     *  Gets station from Track Object (if possible)
     *
     * @SWG\Tag(name="Station")
     * @SWG\Response(
     *     response="200",
     *     description="Station that belongs to TrackObject with given ID",
     *     @Model(type=Station::class)
     * )
     * @SWG\Response(
     *     response="400",
     *     description="TrackObject is not a station"
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Station not found in database"
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Unique track object identifier",
     *     type="integer",
     *     required=true
     * )
     * @Rest\View()
     * @Rest\Get("/by-track-object/{id}")
     * @param TrackObject|null $trackObject
     * @return View
     * @throws TrackObjectIsNotAStationException
     * @throws TrackObjectNotFoundException
     */
    public function getByTrackObjectId(TrackObject $trackObject = null): View
    {
        if (!$trackObject instanceof TrackObject) {
            throw new TrackObjectNotFoundException('route.not-found');
        }

        $station = $trackObject->getStation();
        if (!$station instanceof Station) {
            throw new TrackObjectIsNotAStationException('station.not-found');
        }
        return View::create($station);
    }

    public function add()
    {

    }

    public function edit()
    {

    }

    public function delete()
    {

    }

}
