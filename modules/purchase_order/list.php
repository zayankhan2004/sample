<?php include '../../authentication/auth.php'; ?>


<?php
include '../../config.php';
include '../../templates/header.php';

$result = $conn->query("SELECT * FROM purchase_orders ORDER BY id DESC");
?>

<div class="container mx-auto">

<div class="max-w-5xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">All Purchase Orders</h2>
    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100 whitespace-nowrap">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Company</th>
                <th class="border px-4 py-2">PO Date</th>
                <th class="border px-4 py-2">PO Number</th>
                <th class="border px-4 py-2">PO File</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="whitespace-nowrap">
                <td class="border px-4 py-2"><?= $row['id'] ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['company_name']) ?></td>
                <td class="border px-4 py-2"><?= $row['po_date'] ?></td>
                <td class="border px-4 py-2"><?= htmlspecialchars($row['po_number']) ?></td>
                <td class="border px-4 py-2">
                    <a href="../../uploads/<?= $row['po_file'] ?>" class="text-blue-600 underline" target="_blank">View File</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>

<?php include '../../templates/footer.php'; ?>
