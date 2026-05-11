<aside class="w-64 bg-white border-r border-gray-100 hidden md:block">
    <div class="p-6">
        <h2 class="text-xl font-bold text-orange-600">BOMIS Admin</h2>
    </div>
    <nav class="mt-4 px-4 space-y-2">
        <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-orange-50 text-orange-600' : 'text-gray-500 hover:bg-gray-50'; ?> font-medium transition-all">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="contact_submissions.php" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo basename($_SERVER['PHP_SELF']) == 'contact_submissions.php' ? 'bg-orange-50 text-orange-600' : 'text-gray-500 hover:bg-gray-50'; ?> font-medium transition-all">
            <i class="fas fa-envelope"></i> Contact Forms
        </a>
        <a href="enquiry_submissions.php" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo basename($_SERVER['PHP_SELF']) == 'enquiry_submissions.php' ? 'bg-orange-50 text-orange-600' : 'text-gray-500 hover:bg-gray-50'; ?> font-medium transition-all">
            <i class="fas fa-paper-plane"></i> Enquiry Forms
        </a>
        <a href="subscribers.php" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo basename($_SERVER['PHP_SELF']) == 'subscribers.php' ? 'bg-orange-50 text-orange-600' : 'text-gray-500 hover:bg-gray-50'; ?> font-medium transition-all">
            <i class="fas fa-users"></i> Newsletter
        </a>
        <a href="logs.php" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo basename($_SERVER['PHP_SELF']) == 'logs.php' ? 'bg-orange-50 text-orange-600' : 'text-gray-500 hover:bg-gray-50'; ?> font-medium transition-all">
            <i class="fas fa-history"></i> Activity Logs
        </a>
        <a href="profile.php" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'bg-orange-50 text-orange-600' : 'text-gray-500 hover:bg-gray-50'; ?> font-medium transition-all">
            <i class="fas fa-user-circle"></i> Admin Profile
        </a>
    </nav>
    <div class="absolute bottom-8 left-0 w-64 px-4">
        <a href="../authentication/logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 font-medium transition-all">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>
