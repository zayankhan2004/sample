<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 font-sans text-gray-900">
    <header class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/dashboard/project/index.php" class="text-xl font-bold text-blue-600">Printact Dashboard</a>
          <?php if (isset($_SESSION['user']['username'])): ?>
    <a href="/dashboard/project/logout.php" class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">
        Logout
    </a>
<?php endif; ?>

        </div>
    </header>
