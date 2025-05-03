<?php 

    require_once __DIR__ . '/mpdf/mpdf.php';

	$mpdf = new mPDF();
    $mpdf->use_kwt = true;

    ob_start();
    include 'mis_equipment_booking_op_cct_nct_pdf.php';
    $content = ob_get_clean();

    $mpdf->WriteHTML($content);
    $mpdf->Output();

?>