<?php

namespace App\DataFixtures\TestFixtures;

use App\Entity\Infrastructure\Station;
use App\Entity\Infrastructure\TrackObject;
use App\Services\EntityServices\RouteService;
use App\Services\EntityServices\TrackObjectTypeService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
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
class StationFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var RouteService */
    protected $routeService;

    /** @var TrackObjectTypeService */
    protected $trackObjectTypeService;

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
        $sname = 'Station #';
        $lname = 'Main City Station #';
        $objects = $manager->getRepository(TrackObject::class)->findAll();

        foreach ($objects as $id => $object) {
            $typeName = $object->getType()->getName();
            if ($typeName === 'Station with A category' ||
                $typeName === 'S-Bahn only station' ||
                $typeName === 'All other stations') {
                // if station
                $station = new Station();
                $station->setTrackObject($object)
                        ->setFullName($lname . $id)
                        ->setShortName($sname . $id);
                $manager->persist($station);

            }
        }


        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            RouteFixtures::class,
            TrackObjectFixture::class,
        ];
    }
}
