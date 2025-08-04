<?php include '../../authentication/auth.php'; ?>


<?php
include '../../config.php';

$po_id = $_POST['po_id'];


$fields = [
    "raw_material", "raw_material_transport", "cutting_cost", "cutting_transport", "designing",
    "plates", "printing", "lamination", "misc_transport", "naali_purchase", "naali_transport",
    "paper_purchase", "paper_transport", "corrugation_roll", "slicate_charges", "labor_charges",
    "die_charges", "die_cutting_charges", "pasting", "borai", "misc_charges",
    "total_expense", "total_po_rate", "profit_loss"
];

$types = "i"; // for po_id
$values = [$po_id]; // start with po_id

// Add all numeric fields
foreach ($fields as $field) {
    $values[] = isset($_POST[$field]) ? $_POST[$field] : 0;
    $types .= "d";
}



// Prepare statement
$stmt = $conn->prepare("INSERT INTO expenses (
    po_id, " . implode(", ", $fields) . "
) VALUES (" . rtrim(str_repeat("?,", count($values)), ",") . ")");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind all values at once using unpacking
$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    header("Location: list.php");
    exit;
} else {
    echo "Execute failed: " . $stmt->error;
}
?>
