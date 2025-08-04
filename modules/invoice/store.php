<?php
include '../../authentication/auth.php';
include '../../config.php';
require '../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Basic input validation
$company_name = $_POST['company_name'] ?? '';
$invoice_number = $_POST['invoice_number'] ?? '';
$invoice_date = $_POST['invoice_date'] ?? '';
$items = $_POST['item_name'] ?? [];
$quantities = $_POST['quantity'] ?? [];
$rates = $_POST['rate'] ?? [];

// Validate required fields
if (empty($company_name) || empty($invoice_number) || empty($invoice_date) || empty($items)) {
    die("Missing required invoice fields.");
}

$total = 0;
$items_html = "<table border='1' width='100%' cellspacing='0' cellpadding='8'>
<tr><th>Item</th><th>Qty</th><th>Rate</th><th>Total</th></tr>";

// Build item rows
$item_totals = [];
foreach ($items as $i => $item) {
    $qty = floatval($quantities[$i] ?? 0);
    $rate = floatval($rates[$i] ?? 0);
    $item_total = $qty * $rate;
    $item_totals[] = $item_total;
    $total += $item_total;

    $items_html .= "<tr><td>{$item}</td><td>{$qty}</td><td>{$rate}</td><td>{$item_total}</td></tr>";
}
$items_html .= "</table>";

// Generate PDF
$logo_path = '../../assets/logo.png';
$html = "
    <div style='text-align:center;'>
        <img src='$logo_path' width='100'><br>
        <h2>INVOICE</h2>
    </div>
    <p><strong>Company:</strong> $company_name</p>
    <p><strong>Invoice No:</strong> $invoice_number</p>
    <p><strong>Date:</strong> $invoice_date</p>
    $items_html
    <p><strong>Grand Total:</strong> Rs. $total</p>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Save PDF to uploads/
$pdf_name = 'invoice_' . time() . '.pdf';
$pdf_path = "../../uploads/$pdf_name";
file_put_contents($pdf_path, $dompdf->output());

$sql = "INSERT INTO invoices 
(company_name, invoice_number, invoice_date, item_names, quantities, rates, item_totals, grand_total, total_in_words, invoice_file) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssssssss",
    $company_name,
    $invoice_number,
    $invoice_date,
    json_encode($items),
    json_encode($quantities),
    json_encode($rates),
    json_encode($item_totals),
    $total,
    $total_in_words,
    $pdf_name
);

if ($stmt->execute()) {
    header("Location: list.php");
    exit();
} else {
    die("DB Insert Failed: " . $stmt->error);
}
?>
