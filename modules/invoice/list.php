<?php include '../../authentication/auth.php'; ?>
<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>

<div class="container mx-auto">
<h2 class="text-2xl font-bold mb-4">Invoices</h2>
<table class="w-full border text-sm mb-6">
    <thead class="bg-gray-200">
        <tr><th class="border px-2">#</th><th class="border px-2">Company</th><th class="border px-2">Invoice</th><th class="border px-2">Total</th><th class="border px-2">View</th></tr>
    </thead>
    <tbody>
    <?php
    $res = $conn->query("SELECT * FROM invoices ORDER BY id DESC");
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
            <td class='border px-2'>{$row['id']}</td>
            <td class='border px-2'>{$row['company_name']}</td>
            <td class='border px-2'>{$row['invoice_number']}</td>
            <td class='border px-2'>Rs. {$row['grand_total']}</td>
            <td class='border px-2'><a class='text-blue-600 underline' href='../../uploads/{$row['invoice_file']}' target='_blank'>View</a></td>
        </tr>";
    }
    ?>
    </tbody>
</table>
</div>

<?php include '../../templates/footer.php'; ?>
