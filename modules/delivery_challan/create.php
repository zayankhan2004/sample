<?php include '../../authentication/auth.php'; ?>
<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>

<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Create Delivery Challan</h2>

    <form class="bg-white p-6 rounded shadow-md" action="store.php" method="POST">
        <!-- Basic Details -->
        <input type="text" name="company_name" placeholder="Company Name" class="border rounded w-full p-2 mb-4" required>
        <input type="text" name="dc_number" placeholder="Delivery Challan No." class="border rounded w-full p-2 mb-4" required>
        <input type="date" name="dc_date" class="border rounded w-full p-2 mb-4" required>
        <input type="text" name="delivery_time" placeholder="Delivery Time" class="border rounded w-full p-2 mb-4">
        <input type="text" name="vehicle_no" placeholder="Vehicle Number" class="border rounded w-full p-2 mb-4">
        <input type="text" name="driver_name" placeholder="Driver Name" class="border rounded w-full p-2 mb-4">

        <select name="po_id" class="border rounded w-full p-2 mb-4" required>
            <option value="">Select PO</option>
            <?php
            $res = $conn->query("SELECT id, po_number FROM purchase_orders");
            while ($po = $res->fetch_assoc()) {
                echo "<option value='{$po['id']}'>{$po['po_number']}</option>";
            }
            ?>
        </select>

        <!-- Item Fields -->
        <div id="items-container">
            <div class="flex gap-4 mb-2 item-row">
                <input type="text" name="items[]" placeholder="Item" class="border p-2 w-1/2 rounded" required>
                <input type="number" name="quantities[]" placeholder="Quantity" class="border p-2 w-1/2 rounded" required>
                <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-2 rounded">Remove</button>
            </div>
        </div>

        <button type="button" onclick="addItem()" class="bg-blue-500 text-white px-3 py-1 rounded mb-4">+ Add Item</button> <br>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Generate Challan</button>
    </form>
</div>

<script>
function addItem() {
    const container = document.getElementById('items-container');
    const div = document.createElement('div');
    div.classList.add('flex', 'gap-4', 'mb-2', 'item-row');
    div.innerHTML = `
        <input type="text" name="items[]" placeholder="Item" class="border p-2 w-1/2 rounded" required>
        <input type="number" name="quantities[]" placeholder="Quantity" class="border p-2 w-1/2 rounded" required>
        <button type="button" onclick="removeItem(this)" class="text-red-600 ml-2">−</button>
    `;
    container.appendChild(div);
}

function removeItem(button) {
    const row = button.closest('.item-row');
    if (document.querySelectorAll('.item-row').length > 1) {
        row.remove();
    } else {
        alert("At least one item is required.");
    }
}
</script>

<?php include '../../templates/footer.php'; ?>
