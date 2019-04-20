<?php declare(strict_types=1);


namespace App\Controller\RestAPI;


use App\Services\EntityServices\TrackObjectTypeService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;

/**
 * TrackObjectController
 *
 * @package App\Controller\RestAPI
 */
class TrackObjectTypesController extends AbstractFOSRestController
{
    /** @var TrackObjectTypeService */
    protected $trackObjectTypeService;
    /** @var SerializerInterface */
    protected $serializer;

    /**
     * Assigns data from arguments as class fields
     *
     * @param TrackObjectTypeService $trackObjectTypeService
     * @param SerializerInterface    $serializer
     */
    public function __construct(TrackObjectTypeService $trackObjectTypeService, SerializerInterface $serializer)
    {
        $this->trackObjectTypeService = $trackObjectTypeService;
        $this->serializer = $serializer;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/api/track-object-types/all")
     */
    public function getAll(): View
    {
        $types = $this->trackObjectTypeService->getAll();
        return View::create($types);
    }

    /**
     * @param int $id
     * @return View
     * @Rest\View()
     * @Rest\Get("/api/track-object-types/{id}")
     */
    public function getOne(int $id): View
    {

    }
}

