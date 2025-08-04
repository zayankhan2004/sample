<?php include '../../authentication/auth.php'; ?>


<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>

<div class="container mx-auto">

<h2 class="text-2xl font-bold mb-4">Profit & Loss Summary</h2>

<?php
// Total Invoice Income
$invoiceRes = $conn->query("SELECT SUM(amount) AS total_income FROM invoices");
$invoiceData = $invoiceRes->fetch_assoc();
$total_income = $invoiceData['total_income'] ?? 0;

// Total Expenses
$expenseRes = $conn->query("SELECT SUM(amount) AS total_expense FROM expenses");
$expenseData = $expenseRes->fetch_assoc();
$total_expense = $expenseData['total_expense'] ?? 0;

// Profit/Loss
$profit = $total_income - $total_expense;
?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
    <div class="p-4 bg-green-100 rounded shadow">
        <h3 class="text-lg font-semibold">Total Income</h3>
        <p class="text-2xl text-green-600 font-bold">Rs. <?= number_format($total_income, 2) ?></p>
    </div>
    <div class="p-4 bg-red-100 rounded shadow">
        <h3 class="text-lg font-semibold">Total Expenses</h3>
        <p class="text-2xl text-red-600 font-bold">Rs. <?= number_format($total_expense, 2) ?></p>
    </div>
    <div class="p-4 bg-blue-100 rounded shadow">
        <h3 class="text-lg font-semibold"><?= $profit >= 0 ? "Net Profit" : "Net Loss" ?></h3>
        <p class="text-2xl <?= $profit >= 0 ? 'text-blue-600' : 'text-orange-600' ?> font-bold">
            Rs. <?= number_format(abs($profit), 2) ?>
        </p>
    </div>
</div>
</div>

<?php include '../../templates/footer.php'; ?>
