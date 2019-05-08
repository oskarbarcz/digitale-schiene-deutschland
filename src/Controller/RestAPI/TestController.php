<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use App\Entity\Schedule\ScheduleDataHolder;
use App\Exceptions\NotFound\NoEnoughStationsException;
use App\Services\DomainServices\ScheduleCreator;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

/**
 * Test
 *
 * @package App\Controller\RestAPI
 */
class TestController extends AbstractFOSRestController
{
    /** @var ScheduleCreator */
    protected $scheduleCreator;
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * Assigns data from arguments as class fields
     *
     * @param ScheduleCreator        $scheduleCreator
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ScheduleCreator $scheduleCreator, EntityManagerInterface $entityManager)
    {
        $this->scheduleCreator = $scheduleCreator;
        $this->entityManager = $entityManager;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/test/dupa/{id}")
     * @param int $id
     * @return View
     * @throws NoEnoughStationsException
     */
    public function index(int $id): View
    {
        $scheduleDataHolder = $this->entityManager->find(ScheduleDataHolder::class, $id);
        if (!$scheduleDataHolder instanceof ScheduleDataHolder) {
            return View::create('NO.');
        }

        $schedule = $this->scheduleCreator->create($scheduleDataHolder);

        return View::create($schedule);


    }
}
