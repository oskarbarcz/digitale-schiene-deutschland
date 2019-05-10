<?php

namespace App\DataFixtures\RouteFixtures;

use App\Entity\Infrastructure\TrackObject;
use App\Services\EntityServices\RouteService;
use App\Services\EntityServices\TrackObjectTypeService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use function shuffle;

/**
 * Creates track object for each object and for each type.
 *
 * Watch out! If registered types or object are lots, it'll take a*b time. For example: for 6 types and 4 routes it will
 * give 24 entities.
 *
 * @package App\DataFixtures\TestFixtures
 */
class TrackObjectFixture extends Fixture
{
    /** @var RouteService */
    protected $routeService;

    /** @var TrackObjectTypeService */
    protected $trackObjectTypeService;

    /** @var int */
    private $amount = 4;

    public function __construct(RouteService $routeService, TrackObjectTypeService $trackObjectTypeService)
    {
        $this->routeService = $routeService;
        $this->trackObjectTypeService = $trackObjectTypeService;
    }

    /** @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $name = 'Example Track Object #';
        $types = $this->trackObjectTypeService->getAll();
        $routes = $this->routeService->getAll();
        $objects = [];
        while ($this->amount > 0) {
            foreach ($types as $id_t => $type) {
                foreach ($routes as $id_r => $route) {
                    $max = floor($route->getLength() / 1000);
                    $max *= 1000;
                    // object definition
                    $object = new TrackObject();
                    $object->setName($name . $this->amount . $id_r . $id_t)
                        // set precision to hungreds meters
                           ->setKilometer(random_int(1, $max))
                           ->setRoute($route)
                           ->setType($type);
                    $objects[] = $object;
                }
            }
            $this->amount--;
        }

        // shuffle them
        shuffle($objects);

        // load all
        foreach ($objects as $object) {
            $manager->persist($object);
        }

        $manager->flush();
    }
}
