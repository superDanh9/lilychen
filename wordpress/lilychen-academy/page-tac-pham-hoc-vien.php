<?php
/**
 * Template Name: Tác Phẩm Học Viên (Portfolio Gallery)
 * Template Post Type: page
 *
 * Mẫu trang riêng cho đường dẫn /tac-pham-hoc-vien/ (và /portfolio/).
 * Chuyển giao trực tiếp 100% từ portfolio.html đã duyệt.
 * Bảo toàn thiết kế, bộ lọc tác phẩm, hoạt động TDMU 2025 và thứ tự hình ảnh.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<!-- Structured Data: ImageGallery Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Bộ Sưu Tập Tác Phẩm Học Viên Độc Bản",
  "description": "Hình ảnh tác phẩm trang điểm cô dâu, dạ tiệc, Douyin và sự kiện thực chiến của học viên Lily Chen Makeup Academy Bình Dương.",
  "url": "<?php echo esc_url(home_url('/tac-pham-hoc-vien/')); ?>",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "Lily Chen Makeup Academy",
    "sameAs": "<?php echo esc_url(home_url('/')); ?>"
  }
}
</script>

<main id="mainContent">
    <!-- Page Hero Banner -->
    <section class="page-hero">
      <canvas id="portfolioHeroCanvas" class="particle-canvas page-hero-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
      <div class="container">
        <span class="page-hero-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
          100% Tác Phẩm Thực Tế · Nói Không Với Ảnh Mạng
        </span>
        <h1 class="page-hero-title">Bộ Sưu Tập Tác Phẩm Học Viên Độc Bản</h1>
        <p class="page-hero-desc">
          Mỗi tác phẩm là thành quả từ sự nỗ lực rèn luyện của học viên dưới phương pháp giảng dạy cầm tay chỉ việc 1 kèm 1 của Master Lily Chen. Khám phá các layout đa dạng từ cô dâu, dự tiệc sang trọng đến phong cách Douyin hot trend.
        </p>
        <div class="page-breadcrumbs">
          <a href="<?php echo esc_url(home_url('/')); ?>">Trang Chủ</a>
          <span>/</span>
          <span>Tác Phẩm Học Viên</span>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section class="section-padding" style="background: #ffffff;">
      <div class="container">
        <!-- Category Filter Tabs -->
        <div class="gallery-filters" role="tablist" aria-label="Bộ lọc bộ sưu tập tác phẩm">
          <button type="button" class="gallery-filter-btn active" data-filter="all">Tất Cả Tác Phẩm (12)</button>
          <button type="button" class="gallery-filter-btn" data-filter="codau">Makeup Cô Dâu (4)</button>
          <button type="button" class="gallery-filter-btn" data-filter="tiec">Dự Tiệc &amp; Kỷ Yếu (3)</button>
          <button type="button" class="gallery-filter-btn" data-filter="douyin">Douyin &amp; Cá Nhân (3)</button>
          <button type="button" class="gallery-filter-btn" data-filter="event">Sự Kiện Thực Chiến (2)</button>
        </div>

        <!-- Portfolio Gallery Grid -->
        <div class="gallery-grid" id="galleryGrid" style="margin-bottom: 50px;">
          <!-- Item 1 -->
          <div class="gallery-item" data-category="codau">
            <img src="<?php echo esc_url(lilychen_image_url('tacpham6.webp')); ?>" alt="Tác phẩm makeup cô dâu tone cam đào trong trẻo của học viên Lily Chen" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 2 -->
          <div class="gallery-item" data-category="tiec">
            <img src="<?php echo esc_url(lilychen_image_url('tacpham7.webp')); ?>" alt="Tác phẩm trang điểm dạ tiệc tone nâu tây sang trọng" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 3 -->
          <div class="gallery-item" data-category="douyin">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1644.webp')); ?>" alt="Trang điểm phong cách Douyin bọng mắt tự nhiên" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 4 -->
          <div class="gallery-item" data-category="douyin">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1646.webp')); ?>" alt="Kỹ thuật makeup đi làm 10 phút nền mỏng trong veo" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 5 -->
          <div class="gallery-item" data-category="codau">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1680.webp')); ?>" alt="Layout cô dâu truyền thống áo dài đỏ ngày vu quy" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 6 -->
          <div class="gallery-item" data-category="tiec">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1697.webp')); ?>" alt="Trang điểm kỷ yếu tươi tắn thanh xuân" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 7 -->
          <div class="gallery-item" data-category="douyin">
            <img src="<?php echo esc_url(lilychen_image_url('Nang-cong-so-makeup-di-lam-nhe-nhang-tu-nhien-768x515.webp')); ?>" alt="Layout công sở thanh lịch và tươi tắn" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 8 -->
          <div class="gallery-item" data-category="codau">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1649.webp')); ?>" alt="Kỹ thuật tạo khối sống mũi 3D và đánh phấn bắt sáng highlight" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 9 -->
          <div class="gallery-item" data-category="codau">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1683.webp')); ?>" alt="Layout cô dâu phong cách Glamour hiện đại" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 10 -->
          <div class="gallery-item" data-category="event">
            <img src="<?php echo esc_url(lilychen_image_url('lilychen-team-tdmu-2025.webp')); ?>" alt="Ekip học viên thực chiến King & Queen TDMU 2025" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 11 -->
          <div class="gallery-item" data-category="event">
            <img src="<?php echo esc_url(lilychen_image_url('lilychen-king-queen-collage-2025.webp')); ?>" alt="Các layout trang điểm thí sinh King & Queen 2025" class="gallery-img" loading="lazy">
          </div>

          <!-- Item 12 -->
          <div class="gallery-item" data-category="tiec">
            <img src="<?php echo esc_url(lilychen_image_url('IMG_1644.webp')); ?>" alt="Layout dạ hội chụp ảnh studio chuyên nghiệp" class="gallery-img" loading="lazy">
          </div>
        </div>

        <!-- Real Activity Highlight Card: TDMU King & Queen 2025 -->
        <div class="activity-card" style="margin-bottom: 50px;">
          <div class="activity-info">
            <span class="activity-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
              <span>Bảo Chứng Năng Lực Thực Chiến</span>
            </span>
            <h2 class="activity-title">
              Cọ Xát Thực Chiến Tại Đêm Chung Kết <span class="text-gradient">King &amp; Queen 2025</span>
            </h2>
            <p class="activity-desc">
              Học viên tại Lily Chen không chỉ học trong phòng lab mà còn được Master Lily Chen đưa đi cọ xát thực tế tại các sự kiện văn hóa nghệ thuật lớn. Tại Chung kết Nét Đẹp Sinh Viên TDMU 2025, toàn bộ đội ngũ học viên đã tham gia tài trợ và đảm nhận layout trang điểm cho hàng chục thí sinh xuất sắc.
            </p>
            <div class="activity-highlights">
              <div class="activity-hl-item">
                <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Học viên trực tiếp xử lý trang điểm dưới ánh đèn sân khấu và áp lực thời gian</span>
              </div>
              <div class="activity-hl-item">
                <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Tốt nghiệp có ngay Profile hình ảnh thực tế chất lượng cao để nhận khách</span>
              </div>
            </div>
            <a href="https://zalo.me/0889979791" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">
              <span>Đăng Ký Tham Gia Đội Ngũ Thực Chiến</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>

          <!-- Activity Photos Mosaic -->
          <div class="activity-mosaic">
            <div class="activity-img-wrap">
              <img src="<?php echo esc_url(lilychen_image_url('lilychen-team-tdmu-2025.webp')); ?>" alt="Đội ngũ Lily Chen Makeup Academy tại đêm chung kết King & Queen Đại học Thủ Dầu Một" loading="lazy">
            </div>
            <div class="activity-img-wrap">
              <img src="<?php echo esc_url(lilychen_image_url('lilychen-tdmu-award-ceremony.webp')); ?>" alt="Master Lily Chen trao giải trên sân khấu King & Queen 2025" loading="lazy">
            </div>
            <div class="activity-img-wrap">
              <img src="<?php echo esc_url(lilychen_image_url('lilychen-king-queen-collage-2025.webp')); ?>" alt="Các layout trang điểm thí sinh King & Queen do Lily Chen thực hiện" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Conversion Callout Banner -->
        <div class="roadmap-cta-banner">
          <div class="roadmap-cta-content">
            <h3 class="roadmap-cta-title">Bạn muốn tự tay tạo ra những tác phẩm trang điểm xuất sắc như trên?</h3>
            <p class="roadmap-cta-sub">Master Lily Chen sẽ trực tiếp cầm tay chỉ việc, rèn luyện từng nét cọ từ con số 0 đến khi bạn tự tin làm nghề hoặc tự trang điểm hoàn hảo cho bản thân.</p>
          </div>
          <div class="roadmap-cta-actions">
            <a href="<?php echo esc_url(home_url('/#dang-ky')); ?>" class="btn btn-primary btn-lg" style="box-shadow: 0 4px 18px rgba(255, 141, 161, 0.4);">
              <span>Đăng Ký Khóa Học Ngay · Giảm 10%</span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="https://zalo.me/0889979791" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg" style="background: rgba(255, 255, 255, 0.12); color: #fff; border-color: rgba(255, 255, 255, 0.25);">
              <span>Chat Zalo Tư Vấn Riêng</span>
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
