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
    private const MAGNET_CARD_READER_NOT_FOUND = 'login.errors.magnet-reader.not-found';

    /**
     * @Route("/users/login/card", name="fos_user_security_card")
     * @return Response
     */
    public function login(): Response
    {
        $this->addFlash('warning', self::MAGNET_CARD_READER_NOT_FOUND);
        return $this->render('security/magnet_login.html.twig');
    }

    /**
     * @Route("/login", name="fos_user_security_login_alias")
     * @return Response
     */
    public function loginAlias(): Response
    {
        $this->addFlash('message', 'Przeniesiono na ekran logowania');
        return $this->redirectToRoute('fos_user_security_login');

    }
}
