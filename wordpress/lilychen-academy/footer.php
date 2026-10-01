<?php
/**
 * The Footer for Lily Chen Academy Theme
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$hotline_display = lilychen_get_content('hotline_display', '088 997 97 91');
$hotline_tel     = lilychen_get_content('hotline_tel', '0889979791');
$zalo_url        = lilychen_get_content('zalo_url', 'https://zalo.me/0889979791');
$email           = lilychen_get_content('email', 'lilychenmakeup@gmail.com');
$address         = lilychen_get_content('address', 'B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành, TP. Thủ Dầu Một, Bình Dương');
$hours           = lilychen_get_content('hours', '08:30 - 20:30 (Thứ 2 - CN)');
$fb_url          = lilychen_get_content('fb_url', 'https://www.facebook.com/LilyChenMakeup');
$tiktok_url      = lilychen_get_content('tiktok_url', 'https://tiktok.com/@lilychenmakeup');
?>

  <!-- ========================================================
       FOOTER CAO CẤP (CHARCOAL LUXURY #222428 - CHUẨN LOCAL SEO)
       ======================================================== -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <!-- Col 1: Brand & Bio -->
        <div class="footer-col">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo" aria-label="<?php esc_attr_e('Trang chủ Lily Chen Academy', 'lilychen-academy'); ?>">
            <span class="footer-logo-name">LILY CHEN</span>
            <span class="footer-logo-sub">MAKEUP ACADEMY</span>
          </a>
          <p class="footer-about-text">
            Học viện đào tạo trang điểm cá nhân &amp; chuyên nghiệp chuẩn Boutique tại Thủ Dầu Một, Bình Dương. Tôn vinh nét đẹp độc bản với triết lý đào tạo thực chiến "Cầm tay chỉ việc 1 kèm 1 - Tự nhiên là đỉnh cao".
          </p>
          <div class="footer-hours">
            <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
            <span>Giờ làm việc: <strong><?php echo esc_html($hours); ?></strong></span>
          </div>
          <div class="footer-socials">
            <?php if ($fb_url) : ?>
            <a href="<?php echo esc_url($fb_url); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="<?php esc_attr_e('Facebook Lily Chen Makeup', 'lilychen-academy'); ?>">
              <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <?php endif; ?>
            <?php if ($zalo_url) : ?>
            <a href="<?php echo esc_url($zalo_url); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="<?php esc_attr_e('Zalo Lily Chen', 'lilychen-academy'); ?>">
              <span style="font-weight: 800; font-size: 0.85rem;">Z</span>
            </a>
            <?php endif; ?>
            <?php if ($tiktok_url) : ?>
            <a href="<?php echo esc_url($tiktok_url); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="<?php esc_attr_e('TikTok Lily Chen Makeup', 'lilychen-academy'); ?>">
              <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298-.002.595.042.88.13V9.4a6.33 6.33 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.49 6.27 6.27 0 0 0 1.87-4.48V8.69a8.18 8.18 0 0 0 4.78 1.52v-3.45a4.85 4.85 0 0 1-.88-.07z"/></svg>
            </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Col 2: NAP & Local SEO -->
        <div class="footer-col">
          <h3 class="footer-col-title"><?php esc_html_e('Thông Tin Liên Hệ', 'lilychen-academy'); ?></h3>
          <div class="footer-contact-list">
            <div class="contact-item">
              <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
              <span><strong>Địa chỉ:</strong> <?php echo esc_html($address); ?></span>
            </div>
            <div class="contact-item">
              <svg viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.25 1.02l-2.2 2.2z"/></svg>
              <span><strong>Hotline / Zalo:</strong> <a href="tel:<?php echo esc_attr($hotline_tel); ?>"><?php echo esc_html($hotline_display); ?></a></span>
            </div>
            <div class="contact-item">
              <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
              <span><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
            </div>
            <div class="contact-item">
              <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
              <span><strong>Website:</strong> <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(wp_parse_url(home_url(), PHP_URL_HOST)); ?></a></span>
            </div>
          </div>
        </div>

        <!-- Col 3: Quick Navigation -->
        <div class="footer-col">
          <h3 class="footer-col-title"><?php esc_html_e('Khóa Học & Dịch Vụ', 'lilychen-academy'); ?></h3>
          <?php
          if (has_nav_menu('footer')) {
              wp_nav_menu(array(
                  'theme_location' => 'footer',
                  'container'      => false,
                  'menu_class'     => 'footer-menu-list',
                  'depth'          => 1,
              ));
          } else {
              ?>
              <ul class="footer-menu-list">
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>">Giới Thiệu Học Viện</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/khoa-hoc-trang-diem-ca-nhan/')); ?>">Khóa Makeup Cá Nhân</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/khoa-hoc-trang-diem-chuyen-nghiep/')); ?>">Khóa Makeup Chuyên Nghiệp</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/tac-pham-hoc-vien/')); ?>">Tác Phẩm Học Viên</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/#giang-vien')); ?>">Giảng Viên Lily Chen</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/#cam-nhan')); ?>">Cảm Nhận Học Viên</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog Kiến Thức</a></li>
                <li class="footer-menu-item"><a href="<?php echo esc_url(home_url('/#faq')); ?>">Câu Hỏi Thường Gặp</a></li>
              </ul>
              <?php
          }
          ?>
        </div>

        <!-- Col 4: Google Maps & Local Guide -->
        <div class="footer-col">
          <h3 class="footer-col-title"><?php esc_html_e('Vị Trí Học Viện', 'lilychen-academy'); ?></h3>
          <div class="footer-map-frame">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.6575796982464!2d106.65825227583921!3d10.989218055230911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d1a58df6ea8d%3A0xe54e6027a4d538fe!2zS0RDIEhp4buHcCBTaMOhdCAyLCBIaeG7h3AgVGjDoG5oLCBUaOG7pyBE4bqndSBN4buZdCwgQsOsbmggRMawxqFuZw!5e0!3m2!1svi!2s!4v1711280000000!5m2!1svi!2s" width="100%" height="180" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="<?php esc_attr_e('Bản đồ Lily Chen Makeup Academy Bình Dương', 'lilychen-academy'); ?>"></iframe>
          </div>
          <p style="font-size: 0.8rem; color: #9ca3af; margin-top: 10px; line-height: 1.5;">
            📍 Gần cổng Đại học Thủ Dầu Một &amp; Chợ Đình. Vị trí an ninh, có chỗ đậu xe máy và ô tô thuận tiện.
          </p>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="footer-bottom">
        <div class="footer-copy">
          &copy; <?php echo esc_html(date_i18n('Y')); ?> Lily Chen Makeup Academy. Bản quyền thuộc về Lily Chen. Thiết kế chuẩn Boutique Academy.
        </div>
        <div class="footer-bottom-links">
          <a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>">Giới thiệu</a>
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>">Chính sách bảo mật</a>
          <a href="<?php echo esc_url(home_url('/dieu-khoan-su-dung/')); ?>">Điều khoản sử dụng</a>
          <a href="tel:<?php echo esc_attr($hotline_tel); ?>">Hotline: <?php echo esc_html($hotline_display); ?></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ========================================================
       FLOATING QUICK CONTACT DOCK (MOBILE & DESKTOP FAB)
       ======================================================== -->
  <div class="floating-dock" aria-label="<?php esc_attr_e('Liên hệ nhanh', 'lilychen-academy'); ?>">
    <?php if ($zalo_url) : ?>
    <a href="<?php echo esc_url($zalo_url); ?>" target="_blank" rel="noopener noreferrer" class="fab-btn fab-zalo" title="<?php esc_attr_e('Chat tư vấn qua Zalo', 'lilychen-academy'); ?>" aria-label="<?php echo esc_attr('Chat Zalo ' . $hotline_display); ?>">
      <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo" width="28" height="28" onerror="this.src='<?php echo esc_url(lilychen_image_url('logo-lilychen.png')); ?>'">
    </a>
    <?php endif; ?>
    <a href="tel:<?php echo esc_attr($hotline_tel); ?>" class="fab-btn fab-phone" title="<?php echo esc_attr('Gọi ngay Hotline ' . $hotline_display); ?>" aria-label="<?php echo esc_attr('Gọi điện ' . $hotline_display); ?>">
      <svg viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.25 1.02l-2.2 2.2z"/></svg>
    </a>
  </div>

  <?php wp_footer(); ?>
</body>
</html>
