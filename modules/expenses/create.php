<?php include '../../authentication/auth.php'; ?>


<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>
<div class="container mx-auto">
    
<h2 class="text-2xl font-bold mb-4">Add Expense</h2>

<form class="bg-white p-6 rounded shadow-md" action="store.php" method="POST">
    <!-- Purchase Order Dropdown -->
    <label class="block mb-2 font-semibold">Purchase Order</label>
    <select name="po_id" class="border rounded w-full p-2 mb-4" required>
        <option value="">Select PO</option>
        <?php
        $res = $conn->query("SELECT id, po_number FROM purchase_orders");
        if ($res && $res->num_rows > 0) {
            while ($po = $res->fetch_assoc()) {
                echo "<option value='{$po['id']}'>{$po['po_number']}</option>";
            }
        } else {
            echo "<option disabled>No purchase orders found</option>";
        }
        ?>
    </select>

    <!-- Cost Fields -->
    <?php
    $fields = [
        "raw_material", "raw_material_transport", "cutting_cost", "cutting_transport", "designing",
        "plates", "printing", "lamination", "misc_transport", "naali_purchase", "naali_transport",
        "paper_purchase", "paper_transport", "corrugation_roll", "slicate_charges", "labor_charges",
        "die_charges", "die_cutting_charges", "pasting", "borai", "misc_charges",
        "total_expense", "total_po_rate", "profit_loss"
    ];
    foreach ($fields as $field) {
        echo "<label class='block mb-2 font-semibold'>" . ucwords(str_replace("_", " ", $field)) . "</label>";
        echo "<input type='number' step='0.01' name='{$field}' class='border rounded w-full p-2 mb-4'>";
    }
    ?>

    <!-- Description -->
    <label class="block mb-2 font-semibold">Description</label>
    <input type="text" name="description" class="border rounded w-full p-2 mb-4" required>

    <!-- Submit -->
    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700" type="submit">Save</button>
</form>
</div>

<?php include '../../templates/footer.php'; ?>
