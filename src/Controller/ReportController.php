<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TCPDF;

class ReportController extends AbstractController
{
    /**
     * @Route("/report", name="generate_report")
     */
    public function generateReport(): Response
    {
        // Create new PDF document
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Report');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add content
        $pdf->Write(0, 'Hello, this is a sample report generated using TCPDF.', '', 0, 'L', true, 0, false, false, 0);

        // Output PDF
        $pdf->Output('report.pdf', 'I');

        return new Response();
    }
}