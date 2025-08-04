<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>


<?php include 'templates/header.php'; ?>

<div class="container mx-auto">

<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Management System</h1>
    <div class="grid grid-cols-2 gap-6">
        <a href="modules/purchase_order/create.php" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded shadow text-center">Create Purchase Order</a>
        <a href="modules/purchase_order/list.php" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded shadow text-center">List Purchase Orders</a>
        <a href="modules/delivery_challan/create.php" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded shadow text-center">Create Delivery Challan</a>
        <a href="modules/delivery_challan/list.php" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded shadow text-center">List Delivery Challans</a>
        <a href="modules/invoice/create.php" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded shadow text-center">Create Invoice</a>
        <a href="modules/invoice/list.php" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded shadow text-center">List Invoices</a>
        <a href="modules/expenses/create.php" class="bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded shadow text-center">Add Expenses</a>
        <a href="modules/expenses/list.php" class="bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded shadow text-center">List Expenses</a>
    </div>
</div>
</div>

<?php include 'templates/footer.php'; ?>
