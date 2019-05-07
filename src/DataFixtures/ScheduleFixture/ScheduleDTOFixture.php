<?php declare(strict_types=1);

namespace App\DataFixtures\ScheduleFixture;

use App\Entity\Schedule\ScheduleDataHolder;
use App\Repository\Explicit\TrainServiceRepository;
use App\Repository\Infrastructure\RouteRepository;
use App\Repository\Infrastructure\StationRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * ScheduleDTOFixture
 *
 * @package App\DataFixtures\ScheduleFixture
 */
class ScheduleDTOFixture extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    /** @var RouteRepository */
    protected $routeRepository;
    /** @var TrainServiceRepository */
    protected $trainServiceRepository;
    /** @var StationRepository */
    protected $stationRepository;

    public function __construct(
        RouteRepository $routeRepository,
        TrainServiceRepository $trainServiceRepository,
        StationRepository $stationRepository
    ) {
        $this->routeRepository = $routeRepository;
        $this->trainServiceRepository = $trainServiceRepository;
        $this->stationRepository = $stationRepository;
    }

    /** @inheritDoc */
    public static function getGroups(): array
    {
        return ['schedule'];
    }

    /** @inheritDoc */
    public function load(ObjectManager $manager)
    {
        $route = $this->routeRepository->findOneBy(['kbs' => '9999']);

        $stationA = $this->stationRepository->findOneBy(['shortName' => 'Station A']);
        $stationB = $this->stationRepository->findOneBy(['shortName' => 'Station B']);

        $service = $this->trainServiceRepository->findOneBy(['code' => 'IC']);


        $DTO = new ScheduleDataHolder();
        $DTO->setRoute($route)
            ->setRelationNumber(6400)
            ->setService($service)
            ->setStartTime(new DateTime('now'))
            ->addStation($stationA)
            ->addStation($stationB);

        $manager->persist($DTO);
        $manager->flush();
    }

    /** @inheritDoc */
    public function getDependencies(): array
    {
        return [ScheduleDependentsFixtures::class];
    }
}
