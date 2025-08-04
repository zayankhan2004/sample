<?php include '../../authentication/auth.php'; ?>
<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>

<div class="container mx-auto">
<h2 class="text-2xl font-bold mb-4">Create Invoice</h2>

<form class="bg-white p-6 rounded shadow-md" action="store.php" method="POST">
    <label class="block mb-2 font-semibold">Company Name</label>
    <input type="text" name="company_name" class="border rounded w-full p-2 mb-4" required>

    <label class="block mb-2 font-semibold">Invoice No.</label>
    <input type="text" name="invoice_number" class="border rounded w-full p-2 mb-4" required>

    <label class="block mb-2 font-semibold">Invoice Date</label>
    <input type="date" name="invoice_date" class="border rounded w-full p-2 mb-4" required>

    <!-- Invoice Items Section -->
    <div id="items-container">
        <div class="item-row grid grid-cols-4 gap-4 mb-2">
            <input type="text" name="item_name[]" class="border p-2" placeholder="Item Name" required>
            <input type="number" step="1" name="quantity[]" class="border p-2" placeholder="Qty" required>
            <input type="number" step="0.01" name="rate[]" class="border p-2" placeholder="Rate" required>
            <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-2 rounded">Remove</button>
        </div>
    </div>

    <button type="button" onclick="addItem()" class="bg-blue-500 text-white px-3 py-1 rounded mb-4">Add Item</button>
    <br>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" type="submit">Generate Invoice</button>
</form>
</div>

<script>
function addItem() {
    const container = document.getElementById('items-container');
    const row = document.createElement('div');
    row.className = "item-row grid grid-cols-4 gap-4 mb-2";
    row.innerHTML = `
        <input type="text" name="item_name[]" class="border p-2" placeholder="Item Name" required>
        <input type="number" step="1" name="quantity[]" class="border p-2" placeholder="Qty" required>
        <input type="number" step="0.01" name="rate[]" class="border p-2" placeholder="Rate" required>
        <button type="button" onclick="removeItem(this)" class="bg-red-500 text-white px-2 rounded">Remove</button>
    `;
    container.appendChild(row);
}

function removeItem(button) {
    button.parentElement.remove();
}
</script>

<?php include '../../templates/footer.php'; ?>
