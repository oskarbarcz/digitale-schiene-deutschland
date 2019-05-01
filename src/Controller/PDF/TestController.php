<?php declare(strict_types=1);

namespace App\Controller\PDF;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * TestController
 *
 * @package App\Controller\PDF
 */
class TestController extends AbstractController
{

    public function __construct() { }

    /**
     * @Route("/pdf")
     */
    public function pdf(Pdf $pdf)
    {
        $html = $this->renderView('pdf/pdf_base.twig');

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }

}
