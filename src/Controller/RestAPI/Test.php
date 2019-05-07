<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use App\Entity\Schedule\ScheduleDataHolder;
use App\Services\DomainServices\ScheduleCreator;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

/**
 * Test
 *
 *
 * @package App\Controller\RestAPI
 */
class Test extends AbstractFOSRestController
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
     * @Rest\Get("/api/test/dupa")
     *
     * @return View
     * @throws Exception
     */
    public function index(): View
    {
        $scheduleDataHolder = $this->entityManager->find(ScheduleDataHolder::class, 1);

        $schedule = $this->scheduleCreator->createFromStub($scheduleDataHolder);

        return View::create($schedule);


    }
}
