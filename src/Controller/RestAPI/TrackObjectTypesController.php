<?php declare(strict_types=1);


namespace App\Controller\RestAPI;


use App\Exceptions\NotFound\TrackObjectTypeNotFoundException as NotFound;
use App\Services\EntityServices\TrackObjectTypeService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;

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
     * @Rest\Get("/api/track-object-types/all", name="api__track-object-type_get-all")
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
     * @Rest\Get("/api/track-object-types/{id}", name="api__track-object-type_get-one")
     * @throws NotFound
     */
    public function getOne(int $id): View
    {
        $type = $this->trackObjectTypeService->get($id);
        return View::create($type);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/api/track-object-types", name="api__track-object-type_add")
     * @param Request $request
     * @return View
     */
    public function add(Request $request): View
    {
        // get from request
        $name = $request->get('name');
        $styleClass = $request->get('cssClass');

        $data = $this->trackObjectTypeService->add($name, $styleClass);

        // after success redirect to get one path
        return View::createRouteRedirect('api__track-object-type_get-one', ['id' => $data->getId()]);
    }
}

