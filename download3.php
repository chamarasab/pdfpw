<?php
require_once('vendor/autoload.php');

// Add Sansation font (assuming you have the font file in 'fonts/' directory)
$fontname = TCPDF_FONTS::addTTFfont('fonts/sansation-regular-webfont.ttf', 'TrueTypeUnicode', '', 32);

// Retrieve form data
$customer_name = $_POST['customer_name'];
$loan_installment = $_POST['loan_installment'];

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Bank Loan Reminder');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Set default header data (replace with your bank's logo)
$pdf->SetHeaderData('bank_logo.png', 30, 'Bank Loan Reminder', 'Dear customer, please pay the monthly installment of your loan.');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor (if using a logo)
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$pdf->SetFont($fontname, '', 12);

// Add a page
$pdf->AddPage();

// Generate HTML for the body with justified text
$html = "<h1>Bank Loan Reminder</h1>
<p style=\"text-align: justify;\">Dear {$customer_name},</p>
<p style=\"text-align: justify;\">We hope this message finds you well. This is a reminder to pay your monthly loan installment of {$loan_installment}. Your timely payments contribute greatly to your financial health and our continued ability to support you. If you have any questions or need assistance, please do not hesitate to contact us.</p>
<p style=\"text-align: justify;\">Sincerely,</p>
<p style=\"text-align: justify;\">Your Bank</p>";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Set password protection
$pdf->SetProtection(array('print', 'copy'), '1234', null, 0, null);

// Close and output PDF document
$pdf->Output('bank_loan_reminder.pdf', 'D');
?>
