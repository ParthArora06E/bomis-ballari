<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../config/db.php';

$conn = get_db_connection();

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM newsletter_subscribers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: subscribers.php");
    exit();
}

$subscribers = $conn->query("SELECT * FROM newsletter_subscribers ORDER BY created_at DESC");
?>

<main class="flex-1 p-8">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Newsletter Subscribers</h1>
            <p class="text-gray-500">Manage your mailing list</p>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-2xl">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold">Email Address</th>
                    <th class="px-6 py-4 font-semibold">Subscribed On</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                <?php while($row = $subscribers->fetch_assoc()): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td class="px-6 py-4 text-gray-500"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                    <td class="px-6 py-4 text-right">
                        <a href="?action=delete&id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-700 p-2" onclick="return confirm('Remove this subscriber?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if($subscribers->num_rows == 0): ?>
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">No subscribers yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
