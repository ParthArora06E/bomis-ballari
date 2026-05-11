<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../config/db.php';

$conn = get_db_connection();

$logs = $conn->query("SELECT al.*, a.name as admin_name FROM activity_logs al JOIN admins a ON al.admin_id = a.id ORDER BY al.created_at DESC LIMIT 50");
?>

<main class="flex-1 p-8">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Activity Logs</h1>
            <p class="text-gray-500">Track admin actions and logins</p>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-4xl">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold">Admin</th>
                    <th class="px-6 py-4 font-semibold">Action</th>
                    <th class="px-6 py-4 font-semibold">Timestamp</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                <?php while($row = $logs->fetch_assoc()): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-xs">
                                <?php echo substr($row['admin_name'], 0, 1); ?>
                            </div>
                            <span class="font-medium text-gray-900"><?php echo htmlspecialchars($row['admin_name']); ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($row['action']); ?></td>
                    <td class="px-6 py-4 text-gray-400"><?php echo date('M d, Y • h:i A', strtotime($row['created_at'])); ?></td>
                </tr>
                <?php endwhile; ?>
                <?php if($logs->num_rows == 0): ?>
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">No logs recorded yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
