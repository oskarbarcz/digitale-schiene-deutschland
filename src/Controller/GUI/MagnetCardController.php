<?php declare(strict_types=1);

namespace App\Controller\GUI;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * MagnetCardController
 *
 * @package App\Controller\GUI
 */
class MagnetCardController extends AbstractController
{
    /**
     * @Route("/users/login/card", name="fos_user_security_card")
     * @return Response
     */
    public function login(): Response
    {
        return $this->render('security/magnet_login.html.twig');
    }
}
