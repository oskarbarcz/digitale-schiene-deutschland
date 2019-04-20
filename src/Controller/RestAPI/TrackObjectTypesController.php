<?php declare(strict_types=1);


namespace App\Controller\RestAPI;


use App\Entity\Explicit\TrackObjectType;
use App\Exceptions\NotFound\TrackObjectTypeNotFoundException as NotFound;
use App\Services\EntityServices\TrackObjectTypeService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * TrackObjectController
 *
 * @package App\Controller\RestAPI
 */
class TrackObjectTypesController extends AbstractFOSRestController
{
    /** @var TrackObjectTypeService */
    protected $trackObjectTypeService;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * Assigns data from arguments as class fields
     *
     * @param TrackObjectTypeService $trackObjectTypeService
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface     $validator
     */
    public function __construct(
        TrackObjectTypeService $trackObjectTypeService,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ) {
        $this->trackObjectTypeService = $trackObjectTypeService;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
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
     * @param Request             $request
     * @param SerializerInterface $serializer
     * @return View
     */
    public function add(Request $request, SerializerInterface $serializer): View
    {
        // get from request
        $json = $request->getContent();

        /** @var TrackObjectType $type */
        $type = $serializer->deserialize($json, TrackObjectType::class, 'json');

        $this->validator->validate($type);

        $this->entityManager->persist($type);
        $this->entityManager->flush();

        // return with location header
        return View::create('Success!', 201, [
            'Location' => $this->generateUrl('api__track-object-type_get-one', ['id' => $type->getId()]),
        ]);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/api/track-object-types/{id}", name="api__track-object-type_edit")
     * @param TrackObjectType $trackObjectType
     */
    public function edit(TrackObjectType $trackObjectType): void
    {
        print_r($trackObjectType);
        die;
    }
}

