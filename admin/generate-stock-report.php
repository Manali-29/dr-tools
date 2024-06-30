<?php 
    include_once("dompdf/autoload.inc.php");

    use Dompdf\Dompdf;

    $dom_pdf = new Dompdf();

    ob_start();
    include 'stock-pdf.php';
    $html = ob_get_contents();
    ob_end_clean();

    $dom_pdf->loadHtml($html);
    $dom_pdf->setPaper('A4', 'lnandscape');
    $dom_pdf->render();
    $current_date = date("Y-m-d");
    $dom_pdf->stream("Product-Stock-Report-$current_date.pdf");
    // $pdf = $dom_pdf->output();
    // file_put_contents("ProductReport.pdf", $pdf);
?> 