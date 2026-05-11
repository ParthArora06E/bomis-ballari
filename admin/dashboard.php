<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
require_once __DIR__ . '/../config/db.php';

$conn = get_db_connection();

// Get counts
$contact_count = $conn->query("SELECT COUNT(*) as count FROM contact_forms")->fetch_assoc()['count'];
$enquiry_count = $conn->query("SELECT COUNT(*) as count FROM enquiry_forms")->fetch_assoc()['count'];
$subscriber_count = $conn->query("SELECT COUNT(*) as count FROM newsletter_subscribers")->fetch_assoc()['count'];

// Get recent submissions
$recent_enquiries = $conn->query("SELECT * FROM enquiry_forms ORDER BY created_at DESC LIMIT 5");
?>

<main class="flex-1 p-8">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-gray-500">Welcome back, <?php echo $_SESSION['admin_name']; ?></p>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-gray-500"><?php echo date('F d, Y'); ?></span>
        </div>
    </header>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600">
                    <i class="fas fa-envelope fa-lg"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Contact Submissions</h3>
            <p class="text-2xl font-bold text-gray-900"><?php echo $contact_count; ?></p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                    <i class="fas fa-paper-plane fa-lg"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Enquiry Submissions</h3>
            <p class="text-2xl font-bold text-gray-900"><?php echo $enquiry_count; ?></p>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                    <i class="fas fa-users fa-lg"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium">Newsletter Subscribers</h3>
            <p class="text-2xl font-bold text-gray-900"><?php echo $subscriber_count; ?></p>
        </div>
    </div>

    <!-- Recent Submissions Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-900">Recent Enquiries</h2>
            <a href="enquiry_submissions.php" class="text-sm font-semibold text-orange-600 hover:text-orange-700">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Parent Name</th>
                        <th class="px-6 py-4 font-semibold">Child Name</th>
                        <th class="px-6 py-4 font-semibold">Program</th>
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php while($row = $recent_enquiries->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['parent_name']); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($row['child_name']); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($row['program']); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                        <td class="px-6 py-4">
                            <?php if($row['is_read']): ?>
                                <span class="px-2 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-lg uppercase">Read</span>
                            <?php else: ?>
                                <span class="px-2 py-1 bg-orange-50 text-orange-600 text-xs font-bold rounded-lg uppercase">New</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($recent_enquiries->num_rows == 0): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">No recent submissions found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
