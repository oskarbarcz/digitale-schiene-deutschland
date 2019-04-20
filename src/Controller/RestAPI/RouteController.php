<?php declare(strict_types=1);

namespace App\Controller\RestAPI;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * TrackObjectController
 *
 * @package App\Controller\RestAPI
 */
class RouteController extends AbstractController
{
    public function __construct() { }

    /**
     * @Rest\View()
     * @Rest\Get("", name="")
     */
    public function get()
    {

    }
}

