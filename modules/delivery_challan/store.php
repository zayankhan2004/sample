<?php
include '../../authentication/auth.php';
include '../../config.php';
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Get form inputs
$company_name = $_POST['company_name'];
$dc_number = $_POST['dc_number'];
$dc_date = $_POST['dc_date'];
$po_id = $_POST['po_id'];
$po_result = $conn->prepare("SELECT po_number FROM purchase_orders WHERE id = ?");
$po_result->bind_param("i", $po_id);
$po_result->execute();
$po_data = $po_result->get_result()->fetch_assoc();
$po_number = $po_data['po_number'];
$delivery_time = $_POST['delivery_time'];
$vehicle_no = $_POST['vehicle_no'];
$driver_name = $_POST['driver_name'];
$items = $_POST['items'];
$quantities = $_POST['quantities'];

// Build items HTML
$items_html = "<table border='1' cellpadding='8' cellspacing='0' width='100%'><tr><th>S.No</th><th>Item</th><th>Quantity</th></tr>";
foreach ($items as $i => $item) {
    $items_html .= "<tr><td>" . ($i + 1) . "</td><td>{$item}</td><td>{$quantities[$i]}</td></tr>";
}
$items_html .= "</table>";

// PDF content
$html = "
    <h2 style='text-align:center;'>Delivery Challan</h2>
    <p><strong>Company:</strong> $company_name</p>
    <p><strong>Challan No:</strong> $dc_number</p>
    <p><strong>Date:</strong> $dc_date</p>
    <p><strong>PO No:</strong> $po_number</p>
    <p><strong>Delivery Time:</strong> $delivery_time</p>
    <p><strong>Vehicle No:</strong> $vehicle_no</p>
    <p><strong>Driver:</strong> $driver_name</p><br>
    $items_html
";

// Generate and save PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf_name = 'challan_' . time() . '.pdf';
$pdf_path = '../../uploads/' . $pdf_name;
file_put_contents($pdf_path, $dompdf->output());

// Save to database
$stmt = $conn->prepare("INSERT INTO delivery_challan 
(company_name, dc_number, dc_date, po_id, delivery_time, vehicle_no, driver_name, item, quantity, dc_file)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$item_str = implode(', ', $items);
$qty_str = implode(', ', $quantities);

$stmt->bind_param("sssissssss", $company_name, $dc_number, $dc_date, $po_id, $delivery_time, $vehicle_no, $driver_name, $item_str, $qty_str, $pdf_name);
$stmt->execute();

header("Location: list.php");
exit;
?>
