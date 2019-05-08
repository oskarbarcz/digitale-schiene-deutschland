<?php declare(strict_types=1);

namespace App\Controller\GUI\Schedule;


use App\Entity\Schedule\ScheduleDataHolder;
use App\Exceptions\NotFound\NoEnoughStationsException;
use App\Services\DomainServices\ScheduleCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * ScheduleController
 *
 * @package App\Controller\GUI\Schedule
 */
class ScheduleController extends AbstractController
{
    /** @var ScheduleCreator */
    protected $scheduleCreator;

    public function __construct(ScheduleCreator $scheduleCreator)
    {
        $this->scheduleCreator = $scheduleCreator;
    }

    /**
     * @Route("/schedule/load/{id}")
     * @param ScheduleDataHolder $scheduleDataHolder
     * @return Response
     * @throws NoEnoughStationsException
     */
    public function index(ScheduleDataHolder $scheduleDataHolder): Response
    {
        $schedule = $this->scheduleCreator->create($scheduleDataHolder);
        return $this->render('schedule/basic.html.twig', ['schedule' => $schedule]);
    }
}
