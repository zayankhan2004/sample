<?php include '../../authentication/auth.php'; ?>


<?php
include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company_name = $_POST['company_name'];
    $po_date = $_POST['po_date'];
    $po_number = $_POST['po_number'];

    $file_name = $_FILES['po_file']['name'];
    $file_tmp = $_FILES['po_file']['tmp_name'];
    $upload_path = '../../uploads/' . basename($file_name);

    if (move_uploaded_file($file_tmp, $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO purchase_orders (company_name, po_date, po_number, po_file) VALUES (?, ?, ?, ?)");

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error); // Debug here
        }

        $stmt->bind_param("ssss", $company_name, $po_date, $po_number, $file_name);

        if ($stmt->execute()) {
            echo "<script>alert('Purchase Order created successfully!'); window.location.href='list.php';</script>";
        } else {
            echo "Execute failed: " . $stmt->error;
        }
    } else {
        echo "File upload failed.";
    }
}
?>
