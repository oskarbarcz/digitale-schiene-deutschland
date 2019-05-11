<?php declare(strict_types=1);

namespace App\Controller\GUI\Admin;

use App\Entity\Explicit\Carrier;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * CarriersController
 *
 * @package App\Controller\GUI\Admin
 */
class CarriersController extends AbstractController
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/carriers", name="gui__admin_carrier_all")
     * @return Response
     */
    public function index(): Response
    {
        $carriers = $this->entityManager->getRepository(Carrier::class)->findAll();
        return $this->render('admin/carriers.html.twig', ['carriers' => $carriers]);
    }

}
