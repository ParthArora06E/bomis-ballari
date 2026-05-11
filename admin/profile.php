<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../config/db.php';

$conn = get_db_connection();
$admin_id = $_SESSION['admin_id'];

$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if ($password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admins SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $hashed, $admin_id);
    } else {
        $stmt = $conn->prepare("UPDATE admins SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $admin_id);
    }

    if ($stmt->execute()) {
        $_SESSION['admin_name'] = $name;
        $msg = "Profile updated successfully!";
        
        $log_stmt = $conn->prepare("INSERT INTO activity_logs (action, admin_id) VALUES ('Updated profile', ?)");
        $log_stmt->bind_param("i", $admin_id);
        $log_stmt->execute();
    } else {
        $msg = "Error updating profile.";
    }
}

$stmt = $conn->prepare("SELECT name, email FROM admins WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
?>

<main class="flex-1 p-8">
    <header class="mb-10">
        <h1 class="text-2xl font-bold text-gray-900">Admin Profile</h1>
        <p class="text-gray-500">Update your account settings</p>
    </header>

    <?php if ($msg): ?>
        <div class="max-w-md mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 font-medium">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 max-w-md">
        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($admin['name']); ?>" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all text-gray-900">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all text-gray-900">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password (leave blank to keep current)</label>
                <input type="password" name="password" placeholder="••••••••"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all text-gray-900">
            </div>
            <button type="submit" 
                class="w-full bg-gray-900 hover:bg-black text-white font-bold py-3.5 rounded-xl transition-all active:scale-[0.98]">
                Save Changes
            </button>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
