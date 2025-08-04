<?php include '../../authentication/auth.php'; ?>


<?php
include '../../config.php';
include '../../templates/header.php';

// Define the fields array (must be the same as in your store.php)
$fields = [
    "raw_material", "raw_material_transport", "cutting_cost", "cutting_transport", "designing",
    "plates", "printing", "lamination", "misc_transport", "naali_purchase", "naali_transport",
    "paper_purchase", "paper_transport", "corrugation_roll", "slicate_charges", "labor_charges",
    "die_charges", "die_cutting_charges", "pasting", "borai", "misc_charges",
    "total_expense", "total_po_rate", "profit_loss", "description"
];
?>
<div class="container mx-auto">

<h2 class="text-2xl font-bold mb-4">All Expenses</h2>

<div class="overflow-x-auto">
<table class="w-full border text-sm">
    <thead class="bg-gray-200">
        <tr class="whitespace-nowrap">
            <th class="border px-2 py-1">ID</th>
            <th class="border px-2 py-1">PO No</th>
            <?php
            foreach ($fields as $field) {
                echo "<th class='border px-2 py-1'>" . ucwords(str_replace("_", " ", $field)) . "</th>";
            }
            ?>
           
        </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT e.*, p.po_number FROM expenses e
            JOIN purchase_orders p ON e.po_id = p.id
            ORDER BY e.id DESC";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        echo "<tr class='whitespace-nowrap'>";
        echo "<td class='border px-2 py-1'>{$row['id']}</td>";
        echo "<td class='border px-2 py-1'>{$row['po_number']}</td>";
        foreach ($fields as $field) {
            echo "<td class='border px-2 py-1'>{$row[$field]}</td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</div>
</div>

<?php include '../../templates/footer.php'; ?>
