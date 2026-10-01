<?php
/**
 * Template Name: Liên Hệ (Contact Page)
 * Template Post Type: page
 *
 * Mẫu trang riêng cho đường dẫn /lien-he/ (Liên hệ học viện).
 * Tái hiện trọn vẹn thông tin liên hệ, bản đồ Google Maps, thẻ kết nối nhanh và form tư vấn mô phỏng.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$hotline_display = lilychen_get_content('hotline_display', '088 997 97 91');
$hotline_tel     = lilychen_get_content('hotline_tel', '0889979791');
$zalo_url        = lilychen_get_content('zalo_url', 'https://zalo.me/0889979791');
$email           = lilychen_get_content('email', 'lilychenmakeup@gmail.com');
$address         = lilychen_get_content('address', 'B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành, TP. Thủ Dầu Một, Bình Dương');
$hours           = lilychen_get_content('hours', '08:30 - 20:30 (Thứ 2 - CN)');
$fb_url          = lilychen_get_content('fb_url', 'https://www.facebook.com/LilyChenMakeup');
?>

<!-- Structured Data: ContactPage Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Liên Hệ Lily Chen Makeup Academy",
  "description": "Thông tin liên hệ, vị trí bản đồ và hotline tư vấn khóa học trang điểm tại Lily Chen Makeup Academy Thủ Dầu Một, Bình Dương.",
  "url": "<?php echo esc_url(home_url('/lien-he/')); ?>",
  "mainEntity": {
    "@type": "BeautySalon",
    "name": "Lily Chen Makeup Academy",
    "telephone": "<?php echo esc_attr($hotline_tel); ?>",
    "email": "<?php echo esc_attr($email); ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành",
      "addressLocality": "Thành phố Thủ Dầu Một",
      "addressRegion": "Bình Dương",
      "addressCountry": "VN"
    }
  }
}
</script>

<main id="mainContent">
  <!-- Page Hero Banner -->
  <section class="page-hero">
    <canvas id="contactHeroCanvas" class="particle-canvas page-hero-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
    <div class="container">
      <span class="page-hero-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
        HỖ TRỢ &amp; TƯ VẤN 24/7 · LILY CHEN ACADEMY
      </span>
      <h1 class="page-hero-title">LIÊN HỆ</h1>
      <p class="page-hero-desc">
        Lily Chen Makeup Academy luôn sẵn sàng đón tiếp và tư vấn tận tâm cho bạn về từng lộ trình học tập, xếp lịch học thử hoặc tham quan cơ sở đào tạo.
      </p>
      <div class="page-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>">Trang Chủ</a>
        <span>/</span>
        <span>Liên Hệ</span>
      </div>
    </div>
  </section>

  <!-- Section 1: Contact Information & Google Maps -->
  <section class="section-padding" style="background: #ffffff;">
    <div class="container">
      <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; align-items: start;">
        <!-- Left: Contact Details Card -->
        <div style="background: var(--bg-surface); padding: 36px 30px; border-radius: var(--radius-card); border: 1px solid var(--border-subtle); box-shadow: var(--shadow-sm);">
          <span class="section-tag">THÔNG TIN HỌC VIỆN</span>
          <h2 style="font-family: var(--font-heading); font-size: 1.75rem; color: var(--text-primary); margin-bottom: 24px;">Lily Chen Makeup Academy</h2>
          
          <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; gap: 16px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-rose-soft); color: var(--color-rose); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
              </div>
              <div>
                <strong style="display: block; color: var(--text-primary); font-size: 1rem; margin-bottom: 4px;">Địa chỉ học viện:</strong>
                <span style="color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6;"><?php echo esc_html($address); ?></span>
              </div>
            </div>

            <div style="display: flex; gap: 16px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-rose-soft); color: var(--color-rose); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
              </div>
              <div>
                <strong style="display: block; color: var(--text-primary); font-size: 1rem; margin-bottom: 4px;">Giờ mở cửa:</strong>
                <span style="color: var(--text-secondary); font-size: 0.95rem;"><?php echo esc_html($hours); ?></span>
              </div>
            </div>

            <div style="display: flex; gap: 16px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-rose-soft); color: var(--color-rose); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.25 1.02l-2.2 2.2z"/></svg>
              </div>
              <div>
                <strong style="display: block; color: var(--text-primary); font-size: 1rem; margin-bottom: 4px;">Hotline / Zalo:</strong>
                <a href="tel:<?php echo esc_attr($hotline_tel); ?>" style="color: var(--color-rose-deep); font-weight: 700; font-size: 1.15rem; text-decoration: none;"><?php echo esc_html($hotline_display); ?></a>
              </div>
            </div>

            <div style="display: flex; gap: 16px; align-items: flex-start;">
              <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-rose-soft); color: var(--color-rose); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
              </div>
              <div>
                <strong style="display: block; color: var(--text-primary); font-size: 1rem; margin-bottom: 4px;">Email:</strong>
                <a href="mailto:<?php echo esc_attr($email); ?>" style="color: var(--text-secondary); font-size: 0.95rem; text-decoration: none;"><?php echo esc_html($email); ?></a>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Google Maps Embed -->
        <div style="border-radius: var(--radius-card); overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--border-hairline); min-height: 380px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.4044512734395!2d106.65768427570505!3d11.008250754873474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174cfcd66482895%3A0x3b8b6467fd59eb3d!2sLILYCHEN%20MAKEUP!5e0!3m2!1sen!2s!4v1779531816873!5m2!1sen!2s" width="100%" height="420" style="border:0; display: block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Vị trí Lily Chen Makeup Academy Bình Dương"></iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Section 2: Quick Connect Action Cards -->
  <section class="section-padding" style="background: var(--bg-surface);">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-tag">KẾT NỐI NHANH</span>
        <h2 class="section-title">Chọn Kênh Liên Hệ Tiện Nhất Cho Bạn</h2>
        <p class="section-desc">Đội ngũ trợ giảng và Master Lily Chen luôn trực máy để hỗ trợ giải đáp mọi thắc mắc.</p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 36px;">
        <!-- Card 1: Call -->
        <a href="tel:<?php echo esc_attr($hotline_tel); ?>" style="display: block; text-decoration: none; background: #fff; padding: 32px 24px; border-radius: var(--radius-card); text-align: center; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-sm); transition: transform 0.2s ease, box-shadow 0.2s ease;">
          <div style="width: 56px; height: 56px; border-radius: 50%; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.25 1.02l-2.2 2.2z"/></svg>
          </div>
          <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 6px;">Gọi Điện Trực Tiếp</h3>
          <p style="color: var(--text-secondary); font-size: 0.92rem; margin-bottom: 12px;">Trao đổi nhanh 1-1 với tư vấn viên</p>
          <span style="font-weight: 700; color: var(--color-rose); font-size: 1.1rem;"><?php echo esc_html($hotline_display); ?></span>
        </a>

        <!-- Card 2: Zalo -->
        <a href="<?php echo esc_url($zalo_url); ?>" target="_blank" rel="noopener noreferrer" style="display: block; text-decoration: none; background: #fff; padding: 32px 24px; border-radius: var(--radius-card); text-align: center; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-sm); transition: transform 0.2s ease, box-shadow 0.2s ease;">
          <div style="width: 56px; height: 56px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <span style="font-weight: 900; font-size: 1.5rem; font-family: sans-serif;">Z</span>
          </div>
          <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 6px;">Nhắn Tin Zalo</h3>
          <p style="color: var(--text-secondary); font-size: 0.92rem; margin-bottom: 12px;">Nhận brochure &amp; bảng học phí chi tiết</p>
          <span style="font-weight: 700; color: #0284c7; font-size: 1.1rem;">Chat Zalo Ngay &rarr;</span>
        </a>

        <!-- Card 3: Messenger -->
        <a href="<?php echo esc_url($fb_url); ?>" target="_blank" rel="noopener noreferrer" style="display: block; text-decoration: none; background: #fff; padding: 32px 24px; border-radius: var(--radius-card); text-align: center; border: 1px solid var(--border-subtle); box-shadow: var(--shadow-sm); transition: transform 0.2s ease, box-shadow 0.2s ease;">
          <div style="width: 56px; height: 56px; border-radius: 50%; background: #f3e8ff; color: #7e22ce; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.5 2 2 6.14 2 11.25c0 2.88 1.43 5.45 3.67 7.15V22l3.35-1.84c.9.25 1.85.39 2.98.39 5.5 0 10-4.14 10-9.25S17.5 2 12 2zm.99 12.45l-2.54-2.7-4.96 2.7L10.95 9l2.6 2.7 4.9-2.7-5.46 5.45z"/></svg>
          </div>
          <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 6px;">Chat Messenger</h3>
          <p style="color: var(--text-secondary); font-size: 0.92rem; margin-bottom: 12px;">Xem hình ảnh lớp học &amp; tác phẩm</p>
          <span style="font-weight: 700; color: #7e22ce; font-size: 1.1rem;">Facebook Fanpage &rarr;</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Section 3: Consultation Registration Form (Safe Client Simulation) -->
  <section id="dang-ky" class="section-padding" style="background: #ffffff;">
    <div class="container" style="max-width: 720px;">
      <div class="lead-form-card" style="border: 2px solid var(--border-subtle); box-shadow: var(--shadow-md);">
        <div class="lead-form-header text-center">
          <span class="section-tag">ĐĂNG KÝ TRỰC TUYẾN</span>
          <h2 class="lead-form-title">Gửi Lời Nhắn Đến Lily Chen Academy</h2>
          <p class="lead-form-sub">Để lại số điện thoại hoặc Zalo — chúng tôi sẽ liên hệ trong 24 giờ để xếp lịch tư vấn.</p>
        </div>

        <form id="leadForm" class="lead-form" novalidate>
          <input type="hidden" name="source_page" value="Trang Liên Hệ (/lien-he/)">

          <div class="form-group">
            <label for="leadName" class="form-label">Họ và tên của bạn <span>*</span></label>
            <input type="text" id="leadName" name="name" class="form-control" placeholder="Ví dụ: Nguyễn Phương Mai" required>
          </div>

          <div class="form-group">
            <label for="leadPhone" class="form-label">Số điện thoại / Zalo <span>*</span></label>
            <input type="tel" id="leadPhone" name="phone" class="form-control" placeholder="Ví dụ: 0987 654 321" required>
          </div>

          <div class="form-group">
            <label for="leadCourse" class="form-label">Nội dung bạn muốn tư vấn <span>*</span></label>
            <select id="leadCourse" name="course" class="form-control" required>
              <option value="" disabled selected>-- Chọn nội dung bạn quan tâm --</option>
              <option value="Khóa Makeup Chuyên Nghiệp (25.000.000đ)">Khóa Makeup Chuyên Nghiệp (2-3 tháng · Nhận nghề)</option>
              <option value="Khóa Makeup Cá Nhân (Từ 1.500.000đ)">Khóa Trang Điểm Cá Nhân (Zero-base · 4-5 buổi)</option>
              <option value="Dịch vụ trang điểm cô dâu / sự kiện">Dịch vụ Makeup Cô Dâu / Đi Tiệc / Kỷ Yếu</option>
              <option value="Đặt lịch tham quan học viện">Đặt lịch học thử / Tham quan phòng học tại Bình Dương</option>
            </select>
          </div>

          <div class="form-group">
            <label for="leadTime" class="form-label">Khung giờ thuận tiện để nghe tư vấn</label>
            <select id="leadTime" name="time" class="form-control">
              <option value="Bất kỳ lúc nào">Bất kỳ lúc nào (Trong giờ làm việc)</option>
              <option value="Buổi sáng (08:30 - 11:30)">Buổi sáng (08:30 - 11:30)</option>
              <option value="Buổi chiều (14:00 - 17:00)">Buổi chiều (14:00 - 17:00)</option>
              <option value="Buổi tối (18:00 - 20:30)">Buổi tối (18:00 - 20:30)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="leadMessage" class="form-label">Câu hỏi hoặc ghi chú thêm</label>
            <textarea id="leadMessage" name="message" class="form-control" rows="3" placeholder="Nhập câu hỏi hoặc băn khoăn của bạn..."></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-lg form-submit-btn">
            GỬI THÔNG TIN LIÊN HỆ
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
          </button>

          <div class="form-privacy-note">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
            Thông tin được bảo mật tuyệt đối theo <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>" style="color: inherit; text-decoration: underline;">Chính sách bảo mật</a>.
          </div>

          <!-- Success Notification Box (Test Mode Compatibility) -->
          <div id="formSuccessMsg" class="form-success-msg" role="status" aria-live="polite"></div>
        </form>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
