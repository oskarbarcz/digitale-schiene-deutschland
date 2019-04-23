<?php declare(strict_types=1);

namespace App\Controller\GUI;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * MenuController
 *
 * @package App\Controller\GUI
 */
class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="gui__menu")
     */
    public function menu(): Response
    {
        return $this->render('menu.html.twig');
    }
}
