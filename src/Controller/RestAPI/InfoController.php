<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use function getenv;

/**
 * InfoController
 *
 * @package App\Controller\RestAPI
 */
class InfoController extends AbstractFOSRestController
{
    /**
     * @Rest\View
     * @Rest\Route("/api/info")
     */
    public function info()
    {
        return View::create([
            'appName'     => getenv('APP_NAME'),
            'environment' => getenv('APP_ENV'),
            'apiStatus'   => 'active',
            'host'        => getenv('APP_HOST'),
        ]);
    }
}
