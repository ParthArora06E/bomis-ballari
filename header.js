
document.addEventListener('DOMContentLoaded', () => {
    const placeholder = document.getElementById('header-placeholder');
    if (!placeholder) return;

    const path = window.location.pathname;
    const isSubPage = path.includes('/blogs/') || path.includes('/programs/');
    const base = isSubPage ? '../' : '';

    // Detect active page for nav links
    const isHome = path.endsWith('index.html') || path.endsWith('/');
    const isAbout = path.includes('about.html');
    const isPrograms = path.includes('programs.html') || path.includes('/programs/');
    const isGallery = path.includes('gallery.html');
    const isBlogs = path.includes('blog.html') || path.includes('/blogs/');
    const isEnquiry = path.includes('enquiry.html');
    const isParentsLogin = path.includes('parents-login.html');
    const isStaffLogin = path.includes('staff-login.html');
    const isTestimonials = path.includes('testimonials.html');

    const headerHTML = `
    <!-- Main Navigation Header -->
    <header class="w-full flex justify-center fixed top-0 lg:top-6 left-0 z-[100] pointer-events-none">
        <nav class="w-full lg:max-w-[1240px] bg-white backdrop-blur-md lg:rounded-full px-5 md:px-8 py-3.5 md:py-3 flex items-center justify-between shadow-lg border-b lg:border border-black/5 pointer-events-auto">
            <!-- Logo -->
            <a href="${base}index.html" class="flex items-center cursor-pointer shrink-0">
                <img src="${base}logo/birla-logo-new.png" alt="BOMIS Ballari" class="h-12 md:h-20 lg:h-24 w-auto" loading="lazy">
            </a>

            <!-- Links (Desktop) -->
            <div class="hidden lg:flex items-center gap-7 mx-4">
                <a href="${base}index.html" class="${isHome ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">Home</a>
                <a href="${base}about.html" class="${isAbout ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">About Us</a>
                <a href="${base}programs.html" class="${isPrograms ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">Programs</a>
                <a href="${base}gallery.html" class="${isGallery ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">Gallery</a>
                <a href="${base}testimonials.html" class="${isTestimonials ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">Testimonials</a>
                <a href="${base}blog.html" class="${isBlogs ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">Blogs</a>
                <a href="${base}enquiry.html" class="${isEnquiry ? 'text-[#EA580C] font-semibold' : 'text-[#231F20]/70 hover:text-[#EA580C] font-medium'} text-[14px] transition-colors duration-200">Enquiry</a>
                
                <!-- Login Dropdown -->
                <div class="relative group py-2">
                    <button class="flex items-center gap-1.5 text-[#231F20]/70 hover:text-[#EA580C] font-medium text-[14px] transition-colors duration-200 group-hover:text-[#EA580C]">
                        Login
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-48 bg-white rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.15)] border border-black/5 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="${base}parents-login.html" class="flex items-center px-4 py-2.5 text-[13px] font-semibold text-[#231F20]/80 hover:bg-gray-50 hover:text-[#EA580C] transition-colors">Parents Login</a>
                        <a href="${base}staff-login.html" class="flex items-center px-4 py-2.5 text-[13px] font-semibold text-[#231F20]/80 hover:bg-gray-50 hover:text-[#EA580C] transition-colors">Staff Login</a>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-4 shrink-0">
                <a href="${base}contact.html" class="hidden md:flex bg-[#EA580C] hover:bg-[#D94E05] text-white font-bold text-[13px] px-6 py-2.5 rounded-full transition-all duration-300 shadow-md whitespace-nowrap">Contact Us</a>
                
                <!-- Hamburger Button -->
                <button id="mobile-menu-btn" class="lg:hidden flex flex-col gap-1.5 p-2 focus:outline-none z-[200] relative">
                    <span class="w-6 h-0.5 bg-[#231F20] transition-all duration-300 origin-center" id="bar1"></span>
                    <span class="w-6 h-0.5 bg-[#231F20] transition-all duration-300" id="bar2"></span>
                    <span class="w-6 h-0.5 bg-[#231F20] transition-all duration-300 origin-center" id="bar3"></span>
                </button>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[150] opacity-0 pointer-events-none transition-all duration-300">
        <div id="mobile-menu-content" class="absolute right-0 top-0 h-full w-[85%] max-w-[360px] bg-white shadow-2xl flex flex-col p-8 pt-12 translate-x-full transition-transform duration-500 ease-in-out rounded-l-[32px]">
            <!-- Header inside menu -->
            <div class="flex justify-center items-center mb-10">
                <img src="${base}logo/birla-logo-new.png" alt="Logo" class="h-28 w-auto" loading="lazy">
                <button id="close-menu-btn" class="absolute top-5 left-5 p-1 text-[#231F20]/60 hover:text-[#EA580C] transition-colors z-[9999]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation Links (Mobile) -->
            <nav class="flex flex-col gap-1 overflow-y-auto pb-10 custom-scrollbar">
                <a href="${base}index.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isHome ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Home</a>
                <a href="${base}about.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isAbout ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">About Us</a>
                <a href="${base}programs.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isPrograms ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Programs</a>
                <a href="${base}gallery.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isGallery ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Gallery</a>
                <a href="${base}testimonials.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isTestimonials ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Testimonials</a>
                <a href="${base}blog.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isBlogs ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Blogs</a>
                <a href="${base}contact.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 text-[#231F20] font-semibold text-[17px]">Contact Us</a>
                <a href="${base}enquiry.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isEnquiry ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Enquiry</a>
                <a href="${base}parents-login.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isParentsLogin ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Parents Login</a>
                <a href="${base}staff-login.html" class="flex items-center justify-between py-3.5 border-b border-gray-50 ${isStaffLogin ? 'text-[#EA580C] font-bold' : 'text-[#231F20] font-semibold'} text-[17px]">Staff Login</a>
            </nav>

        </div>
    </div>
    <style>
        @media (min-width: 1024px) {
            #mobile-menu-overlay { display: none !important; }
        }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }
    </style>
    `;

    placeholder.innerHTML = headerHTML;

    // Mobile Menu Logic
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('close-menu-btn');
    const overlay = document.getElementById('mobile-menu-overlay');
    const content = document.getElementById('mobile-menu-content');
    const body = document.body;

    const bar1 = document.getElementById('bar1');
    const bar2 = document.getElementById('bar2');
    const bar3 = document.getElementById('bar3');

    function openMenu() {
        overlay.classList.remove('pointer-events-none', 'opacity-0');
        overlay.classList.add('opacity-100');
        content.classList.remove('translate-x-full');
        body.style.overflow = 'hidden';
        
        // Animate Hamburger to X
        bar1.style.transform = 'translateY(8px) rotate(45deg)';
        bar2.style.opacity = '0';
        bar3.style.transform = 'translateY(-8px) rotate(-45deg)';
    }

    function closeMenu() {
        overlay.classList.add('opacity-0');
        overlay.classList.add('pointer-events-none');
        overlay.classList.remove('opacity-100');
        content.classList.add('translate-x-full');
        body.style.overflow = '';

        // Animate X back to Hamburger
        bar1.style.transform = '';
        bar2.style.opacity = '1';
        bar3.style.transform = '';
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            openMenu();
        });
    }
    
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    
    if (overlay) {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeMenu();
        });
    }

    // Close on link click
    content.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Header Scroll Effect
    const nav = placeholder.querySelector('nav');
    function handleScroll() {
        if (window.scrollY > 20) {
            nav.classList.add('shadow-xl', 'border-black/10');
            nav.classList.remove('shadow-lg', 'border-black/5');
        } else {
            nav.classList.add('shadow-lg', 'border-black/5');
            nav.classList.remove('shadow-xl', 'border-black/10');
        }
    }
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check
});
