<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../config/db.php';

$conn = get_db_connection();

// Handle Actions
if (isset($_GET['action'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] == 'delete') {
        $stmt = $conn->prepare("DELETE FROM enquiry_forms WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } elseif ($_GET['action'] == 'mark_read') {
        $stmt = $conn->prepare("UPDATE enquiry_forms SET is_read = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: enquiry_submissions.php");
    exit();
}

// Handle Export
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    $result = $conn->query("SELECT * FROM enquiry_forms ORDER BY created_at DESC");
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="enquiries_' . date('Y-m-d') . '.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Parent Name', 'Child Name', 'Child Age', 'Program', 'Phone', 'Email', 'Message', 'Date']);
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['id'], $row['parent_name'], $row['child_name'], $row['child_age'], $row['program'], $row['phone'], $row['email'], $row['message'], $row['created_at']]);
    }
    fclose($output);
    exit();
}

$submissions = $conn->query("SELECT * FROM enquiry_forms ORDER BY created_at DESC");
?>

<main class="flex-1 p-8">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Enquiry Submissions</h1>
            <p class="text-gray-500">Manage all admission inquiries</p>
        </div>
        <div class="flex gap-3">
            <a href="?export=csv" class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all flex items-center gap-2">
                <i class="fas fa-download"></i> Export CSV
            </a>
        </div>
    </header>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Details</th>
                        <th class="px-6 py-4 font-semibold">Contact</th>
                        <th class="px-6 py-4 font-semibold">Message</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    <?php while($row = $submissions->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50/50 transition-colors <?php echo !$row['is_read'] ? 'bg-orange-50/10' : ''; ?>">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900"><?php echo htmlspecialchars($row['parent_name']); ?></div>
                            <div class="text-gray-500 text-xs mt-1">Child: <?php echo htmlspecialchars($row['child_name']); ?> (<?php echo htmlspecialchars($row['child_age']); ?>)</div>
                            <div class="text-orange-600 text-[11px] font-bold uppercase mt-1"><?php echo htmlspecialchars($row['program']); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-phone text-gray-400 text-xs"></i> <?php echo htmlspecialchars($row['phone']); ?>
                            </div>
                            <div class="flex items-center gap-2 text-gray-500 text-xs mt-1">
                                <i class="fas fa-envelope text-gray-400 text-xs"></i> <?php echo htmlspecialchars($row['email']); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="text-gray-600 line-clamp-2"><?php echo htmlspecialchars($row['message'] ?: 'No message'); ?></p>
                            <div class="text-[10px] text-gray-400 mt-2"><?php echo date('M d, Y • h:i A', strtotime($row['created_at'])); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <?php if(!$row['is_read']): ?>
                                <span class="px-2 py-1 bg-orange-100 text-orange-700 text-[10px] font-bold rounded-lg uppercase">New</span>
                            <?php else: ?>
                                <span class="px-2 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold rounded-lg uppercase">Read</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <?php if(!$row['is_read']): ?>
                                    <a href="?action=mark_read&id=<?php echo $row['id']; ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Mark as Read">
                                        <i class="fas fa-check"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="?action=delete&id=<?php echo $row['id']; ?>" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete" onclick="return confirm('Are you sure you want to delete this?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
