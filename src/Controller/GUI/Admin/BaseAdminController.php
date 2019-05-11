<?php declare(strict_types=1);

namespace App\Controller\GUI\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * BaseAdminController
 *
 * @package App\Controller\GUI\Admin
 */
class BaseAdminController extends AbstractController
{
    public function __construct() { }

    /**
     * @Route("/admin")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin.html.twig');
    }
}
