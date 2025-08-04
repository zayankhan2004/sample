<?php
session_start();
include './config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Optionally store username in cookie if "Remember Me" is checked
    if (isset($_POST['remember'])) {
        setcookie('remember_username', $username, time() + (86400 * 30), "/"); // 30 days
    } else {
        setcookie('remember_username', '', time() - 3600, "/");
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Login</h2>
        <form method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input
                    name="username"
                    type="text"
                    id="username"
                    value="<?= isset($_COOKIE['remember_username']) ? htmlspecialchars($_COOKIE['remember_username']) : '' ?>"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400"
                >
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input
                        name="password"
                        type="password"
                        id="password"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400"
                    >
                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-2 top-2 text-sm text-blue-600 hover:underline"
                    >Show</button>
                </div>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2" <?= isset($_COOKIE['remember_username']) ? 'checked' : '' ?>>
                <label for="remember" class="text-sm text-gray-700">Remember Me</label>
            </div>
            
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
            >Login</button>
            <?php if (isset($error)): ?>
                <p class="text-red-600 text-sm mt-2 text-center"><?= $error ?></p>
            <?php endif; ?>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleBtn = event.target;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleBtn.innerText = "Hide";
            } else {
                passwordInput.type = "password";
                toggleBtn.innerText = "Show";
            }
        }
    </script>
</body>
</html>
