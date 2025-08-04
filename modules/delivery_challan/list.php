<?php include '../../authentication/auth.php'; ?>
<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>

<div class="container mx-auto">
<h2 class="text-2xl font-bold mb-4">All Delivery Challans</h2>

<table class="w-full border text-sm">
    <thead class="bg-gray-200">
        <tr>
            <th class="border px-2 py-1">ID</th>
            <th class="border px-2 py-1">Company</th>
            <th class="border px-2 py-1">DC No</th>
            <th class="border px-2 py-1">Date</th>
            <th class="border px-2 py-1">PO No</th>
            <th class="border px-2 py-1">Item</th>
            <th class="border px-2 py-1">File</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT d.*, p.po_number FROM delivery_challan d
            JOIN purchase_orders p ON d.po_id = p.id
            ORDER BY d.id DESC";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
            <td class='border px-2 py-1'>{$row['id']}</td>
            <td class='border px-2 py-1'>{$row['company_name']}</td>
            <td class='border px-2 py-1'>{$row['dc_number']}</td>
            <td class='border px-2 py-1'>{$row['dc_date']}</td>
            <td class='border px-2 py-1'>{$row['po_number']}</td>
            <td class='border px-2 py-1'>{$row['item']}</td>
            <td class='border px-2 py-1'>
                <a href='../../uploads/{$row['dc_file']}' target='_blank' class='text-blue-500 underline'>View PDF</a>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>
</div>

<?php include '../../templates/footer.php'; ?>
