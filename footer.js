
/**
 * Global Footer Component
 * Injects the standardized BOMIS Ballari footer into all pages.
 */
document.addEventListener('DOMContentLoaded', () => {
    const footerPlaceholder = document.getElementById('footer-placeholder');
    if (!footerPlaceholder) return;

    // Detect path depth to adjust relative links
    const path = window.location.pathname;
    const isSubPage = path.includes('/blogs/') || path.includes('/programs/');
    const base = isSubPage ? '../' : '';

    const footerHTML = `
  <footer class="relative bg-[#E9D18F] pt-24 pb-28 px-6 md:px-12 overflow-hidden flex flex-col items-center w-full">
    <!-- Top Section Divider Curve -->
    <div class="absolute left-0 right-0 w-full overflow-hidden z-20 pointer-events-none" style="top: -5px; line-height: 0;">
      <svg class="block w-full h-[60px]" viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" fill="#f7f5f2" style="stroke: none;">
        <path d="M0 0 L1440 0 L1440 30 Q 1080 80 0 20 Z"></path>
      </svg>
    </div>
    
    <div class="relative z-10 w-full max-w-[1360px] flex flex-col gap-16">
      <!-- Main Footer Content -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.5fr_1fr_1fr_1fr] gap-12 items-start text-left">
        
        <!-- Column 1: Brand -->
        <div class="flex flex-col gap-6">
          <a href="${base}index.html" class="inline-block">
            <img src="${base}logo/footer-logo.png" alt="BOMIS Ballari" class="h-32 md:h-44 lg:h-48 w-auto" loading="lazy">
          </a>
          <p class="text-[#57534E] text-[15px] leading-relaxed max-w-[320px]">
            Safe, playful early education for children aged 1–6, guided by experienced educators who nurture curiosity.
          </p>
          
          <div class="flex flex-col gap-4 mt-2">
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#e25d2a] mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.81 12.81 0 0 0 .62 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.62A2 2 0 0 1 22 16.92z"></path></svg>
              <div class="flex flex-col text-[#57534E] text-[15px] font-medium">
                <a href="tel:+919035067072" class="hover:text-[#231F20] transition-colors">+91 9035067072</a>
                <a href="tel:+919035076073" class="hover:text-[#231F20] transition-colors">9035076073</a>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#e25d2a] mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
              <a href="mailto:principal.ballari@birlaopenminds.com" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors break-all">principal.ballari@birlaopenminds.com</a>
            </div>
            <div class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#e25d2a] mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              <p class="text-[#57534E] text-[15px] font-medium leading-tight">Near Pyramid center, Opp sanganakallu hill, Moka road, Ballari</p>
            </div>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="flex flex-col gap-5">
          <h3 class="text-[18px] font-bold text-[#231F20]">Quick Links</h3>
          <ul class="flex flex-col gap-3">
            <li><a href="${base}index.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Home</a></li>
            <li><a href="${base}about.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">About Us</a></li>
            <li><a href="${base}programs.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Programs</a></li>
            <li><a href="${base}blog.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Blogs</a></li>
          </ul>
        </div>

        <!-- Column 3: For Parents -->
        <div class="flex flex-col gap-5">
          <h3 class="text-[18px] font-bold text-[#231F20]">For Parents</h3>
          <ul class="flex flex-col gap-3">
            <li><a href="${base}gallery.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Gallery</a></li>
            <li><a href="${base}contact.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Contact Us</a></li>
            <li><a href="${base}enquiry.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Admission Enquiry</a></li>
          </ul>
        </div>

        <!-- Column 4: Portal -->
        <div class="flex flex-col gap-5">
          <h3 class="text-[18px] font-bold text-[#231F20]">Portal</h3>
          <ul class="flex flex-col gap-3">
            <li><a href="${base}parents-login.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Parents Login</a></li>
            <li><a href="${base}staff-login.html" class="text-[#57534E] text-[15px] font-medium hover:text-[#231F20] transition-colors duration-200">Staff Login</a></li>
          </ul>
        </div>

      </div>

      <!-- Thin Divider Line -->
      <div class="w-full h-[1px] bg-[#231F20]/10"></div>

      <!-- Bottom Bar -->
      <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <p class="text-[#57534E] text-[14px]">
          © 2026 Birla Open Minds. All rights reserved.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center gap-8">
          <!-- Social Icons -->
          <div class="flex items-center gap-4">
            <a href="https://www.facebook.com/share/1G9zZF1Zmb/" target="_blank" class="text-[#231F20] hover:opacity-70 transition-opacity duration-200" aria-label="Facebook">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
              </svg>
            </a>
            <a href="https://www.instagram.com/birla.openmindsballari?utm_source=qr&igsh=MW8yNTQ3ZDBsazQydA==" target="_blank" class="text-[#231F20] hover:opacity-70 transition-opacity duration-200" aria-label="Instagram">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
              </svg>
            </a>
          </div>

          <!-- Legal Links -->
          <div class="flex items-center gap-3 text-[#57534E] text-[14px] font-medium">
            <a href="#" class="hover:text-[#231F20] transition-colors duration-200">Terms & Condition</a>
            <span class="opacity-30">|</span>
            <a href="#" class="hover:text-[#231F20] transition-colors duration-200">Privacy Policy</a>
          </div>
        </div>
      </div>

    </div>
  </footer>
    `;
    footerPlaceholder.innerHTML = footerHTML;
});
