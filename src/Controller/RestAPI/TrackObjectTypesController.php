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
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * TrackObjectType related actions
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
    /** @var SerializerInterface */
    protected $serializer;

    /**
     * Assigns data from arguments as class fields
     *
     * @param TrackObjectTypeService $trackObjectTypeService
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface     $validator
     * @param SerializerInterface    $serializer
     */
    public function __construct(
        TrackObjectTypeService $trackObjectTypeService,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ) {
        $this->trackObjectTypeService = $trackObjectTypeService;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * Returns all TrackObjectType collection
     *
     * @SWG\Tag(name="TrackObjectType")
     * @SWG\Response(
     *     response="200",
     *     description="Returns all registered track object types."
     * )
     * @Rest\View()
     * @Rest\Get("/api/track-object-types/all", name="api__track-object-type_get-all")
     */
    public function getAll(): View
    {
        $types = $this->trackObjectTypeService->getAll();
        return View::create($types);
    }

    /**
     * Returns TrackObjectType by ID
     *
     * @SWG\Tag(name="TrackObjectType")
     * @SWG\Parameter(
     *     in="path",
     *     type="integer",
     *     name="Unique identifer"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns TrackObjectType by ID.",
     *     @Model(type=TrackObjectType::class)
     * )
     * @Rest\View()
     * @Rest\Get("/api/track-object-types/{id}", name="api__track-object-type_get-one")
     *
     * @param int $id
     * @return View
     * @throws NotFound
     */
    public function getOne(int $id): View
    {
        $type = $this->trackObjectTypeService->get($id);
        return View::create($type);
    }

    /**
     * Adds a track object type
     *
     * @SWG\Tag(name="TrackObjectType")
     * @SWG\Response(
     *     response="200",
     *     description="Returns all registered track object types."
     * )
     * @Rest\View()
     * @Rest\Post("/api/track-object-types", name="api__track-object-type_add")
     * @param Request $request
     * @return View
     */
    public function add(Request $request): View
    {
        // get from request
        $json = $request->getContent();

        /** @var TrackObjectType $type */
        $type = $this->serializer->deserialize($json, TrackObjectType::class, 'json');

        $this->validator->validate($type);

        $this->entityManager->persist($type);
        $this->entityManager->flush();

        // return with location header
        return View::create('Success!', 201, [
            'Location' => $this->generateUrl('api__track-object-type_get-one', ['id' => $type->getId()]),
        ]);
    }

    /**
     * Edits track object type
     *
     * @SWG\Tag(name="TrackObjectType")
     * @SWG\Response(
     *     response="200",
     *     description="Returns all registered track object types."
     * )
     * @Rest\View()
     * @Rest\Patch("/api/track-object-types/{id}", name="api__track-object-type_edit")
     * @param Request         $request
     * @param TrackObjectType $oldType
     * @return View
     */
    public function edit(Request $request, TrackObjectType $oldType): View
    {
        // get from request
        $json = $request->getContent();

        /** @var TrackObjectType $updated */
        $updated = $this->serializer->deserialize($json, TrackObjectType::class, 'json');

        $oldType->setName($updated->getName())
                ->setStyleClass($updated->getStyleClass());

        $this->validator->validate($oldType);

        $this->entityManager->persist($oldType);
        $this->entityManager->flush();

        // return with location header
        return View::create($oldType, 200, [
            'Location' => $this->generateUrl('api__track-object-type_get-one', ['id' => $oldType->getId()]),
        ]);
    }

    /**
     * Deletes the track object type
     *
     * @SWG\Tag(name="TrackObjectType")
     * @SWG\Response(
     *     response="204",
     *     description="Deletes selected track object type"
     * )
     * @Rest\View()
     * @Rest\Delete("/api/track-object-types/{id}", name="api__track-object-type_delete")
     *
     * @param int $id
     * @return View
     * @throws NotFound
     */
    public function delete(int $id): View
    {
        $this->trackObjectTypeService->delete($id);
        return View::create();
    }
}

