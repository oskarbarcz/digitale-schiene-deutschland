<?php declare(strict_types=1);


namespace App\Controller\RestAPI;


use App\Exceptions\NotFound\TrackObjectTypeNotFoundException as NotFound;
use App\Services\EntityServices\TrackObjectTypeService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;

/**
 * TrackObjectController
 *
 * @package App\Controller\RestAPI
 */
class TrackObjectTypesController extends AbstractFOSRestController
{
    /** @var TrackObjectTypeService */
    protected $trackObjectTypeService;

    /**
     * Assigns data from arguments as class fields
     *
     * @param TrackObjectTypeService $trackObjectTypeService
     */
    public function __construct(TrackObjectTypeService $trackObjectTypeService)
    {
        $this->trackObjectTypeService = $trackObjectTypeService;
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
     * @throws NotFound
     */
    public function getOne(int $id): View
    {
        $type = $this->trackObjectTypeService->get($id);
        return View::create($type);
    }
}

