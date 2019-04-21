<?php declare(strict_types=1);

namespace App\Services\EntityServices;

use App\Entity\Infrastructure\Route;
use App\Exceptions\NotFound\RouteNotFoundException;
use App\Repository\Infrastructure\RouteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * RouteService
 *
 * @package App\Services\EntityServices
 */
class RouteService
{
    private const ROUTE_NOT_FOUND = 'route.not-found';
    /** @var RouteRepository */
    protected $repository;
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var ValidatorInterface */
    protected $validator;

    public function __construct(
        RouteRepository $repository,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * Returns route by it's KBS number
     *
     * @param int $kbs
     * @return Route
     * @throws RouteNotFoundException
     */
    public function get(int $kbs): Route
    {
        $route = $this->repository->findOneBy(['kbs' => $kbs]);
        if (!$route instanceof Route) {
            throw new RouteNotFoundException(self::ROUTE_NOT_FOUND);
        }
        return $route;
    }

    /**
     * Facade function for getting all routes
     *
     * @return Route[]
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function add()
    {

    }

    public function edit()
    {

    }

    /**
     * Deletes the route with given KBS
     *
     * @param int $kbs
     * @throws RouteNotFoundException
     */
    public function delete(int $kbs): void
    {
        $route = $this->get($kbs);
        $this->entityManager->remove($route);
    }

    public function __destruct()
    {
        $this->entityManager->flush();
    }
}
