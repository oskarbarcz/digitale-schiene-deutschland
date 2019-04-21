<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use App\Controller\Abstracts\AbstractValidatorFOSRestController;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use App\Exceptions\NotFound\RouteNotFoundException;
use App\Exceptions\NotFound\StationNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
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
     * Returns all stations
     *
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
     * @param Route $route
     * @return View
     * @throws RouteNotFoundException
     */
    public function getByRoute(Route $route): View
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
