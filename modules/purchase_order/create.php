<?php include '../../authentication/auth.php'; ?>


<?php include '../../templates/header.php'; ?>
<div class="container mx-auto">

<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Create Purchase Order</h2>
    <form action="store.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="company_name" placeholder="Company Name" required class="w-full mb-4 border p-2">
        <input type="date" name="po_date" required class="w-full mb-4 border p-2">
        <input type="text" name="po_number" placeholder="PO Number" required class="w-full mb-4 border p-2">
        
        <label class="block mb-2 font-medium">PO File (PDF/Image)</label>
        <input type="file" name="po_file" required class="w-full mb-4 border p-2">
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
</div>

<?php include '../../templates/footer.php'; ?>
