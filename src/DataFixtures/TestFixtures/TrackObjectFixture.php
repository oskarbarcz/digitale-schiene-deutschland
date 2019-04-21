<?php

namespace App\DataFixtures\TestFixtures;

use App\Entity\Infrastructure\TrackObject;
use App\Services\EntityServices\RouteService;
use App\Services\EntityServices\TrackObjectTypeService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

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

    private const AMOUNT = 4;

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
        $i = self::AMOUNT;

        while ($i > 0) {
            foreach ($types as $id_t => $type) {
                foreach ($routes as $id_r => $route) {
                    // object definition
                    $object = new TrackObject();
                    $object->setName($name . $i . $id_r . $id_t)
                           ->setKilometer(random_int(1, 30000))
                           ->setRoute($route)
                           ->setType($type);
                    $manager->persist($object);
                }
            }
            $i--;
        }

        $manager->flush();
    }
}
