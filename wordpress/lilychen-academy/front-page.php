<?php
/**
 * The Front Page template for Lily Chen Academy Theme
 * Converts the approved index.html into a dynamic, manageable WordPress template.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

// Hero options
$hero_location  = lilychen_get_content('hero_location', 'Thủ Dầu Một · Bình Dương');
$hero_title_1   = lilychen_get_content('hero_title_1', 'Đào tạo Makeup Chuyên nghiệp');
$hero_title_2   = lilychen_get_content('hero_title_2', '& Cá nhân');
$hero_cta1_text = lilychen_get_content('hero_cta1_text', 'Xem khóa học');
$hero_cta1_url  = lilychen_get_content('hero_cta1_url', '#khoa-hoc');
$hero_cta2_text = lilychen_get_content('hero_cta2_text', 'Xem tác phẩm');
$hero_cta2_url  = lilychen_get_content('hero_cta2_url', home_url('/tac-pham-hoc-vien/'));
if (empty($hero_cta2_url) || strpos($hero_cta2_url, '/portfolio') !== false) {
    $hero_cta2_url = home_url('/tac-pham-hoc-vien/');
}

// Mosaic images (editable via Media Library)
$mosaic_1 = lilychen_get_content('mosaic_img_1', lilychen_image_url('tacpham6.webp'));
$mosaic_2 = lilychen_get_content('mosaic_img_2', lilychen_image_url('IMG_1644.webp'));
$mosaic_3 = lilychen_get_content('mosaic_img_3', lilychen_image_url('IMG_1680.webp'));
$mosaic_4 = lilychen_get_content('mosaic_img_4', lilychen_image_url('tacpham7.webp'));
$mosaic_5 = lilychen_get_content('mosaic_img_5', lilychen_image_url('IMG_1646.webp'));

// Courses data & images (editable via Media Library)
$pro_price       = lilychen_get_content('course_pro_price', '25.000.000đ');
$pro_price_sub   = lilychen_get_content('course_pro_price_sub', 'Hỗ trợ trả góp linh hoạt 2–3 đợt · Tặng bộ cọ chuyên nghiệp cao cấp');
$pro_img         = lilychen_get_content('course_pro_image', lilychen_image_url('lilychen-king-queen-collage-2025.webp'));
$pro_summary     = lilychen_get_content('course_pro_summary', 'Đào tạo nghề toàn diện cho người muốn trở thành Makeup Artist tự do, làm việc tại bridal studio hoặc tự mở tiệm trang điểm. 90% thực hành mẫu thật dưới sự kèm cặp 1-1 trực tiếp của Master Lily Chen.');

$per_price       = lilychen_get_content('course_personal_price', 'Từ 1.500.000đ');
$per_price_sub   = lilychen_get_content('course_personal_price_sub', 'Mỹ phẩm & dụng cụ thực hành được chuẩn bị sẵn 100% tại lớp');
$per_img         = lilychen_get_content('course_personal_image', lilychen_image_url('IMG_1646.webp'));
$per_summary     = lilychen_get_content('course_personal_summary', 'Tự tin trang điểm nhẹ nhàng, tôn nét tự nhiên chỉ sau 10–15 phút mỗi sáng và làm chủ layout dự tiệc thanh lịch, không phụ thuộc tiệm. Giáo trình cá nhân hóa theo từng dáng mặt.');

// Gallery artwork images (editable via Media Library)
$art_1 = lilychen_get_content('gallery_art_1', lilychen_image_url('tacpham6.webp'));
$art_2 = lilychen_get_content('gallery_art_2', lilychen_image_url('tacpham7.webp'));
$art_3 = lilychen_get_content('gallery_art_3', lilychen_image_url('IMG_1644.webp'));
$art_4 = lilychen_get_content('gallery_art_4', lilychen_image_url('IMG_1646.webp'));
$art_5 = lilychen_get_content('gallery_art_5', lilychen_image_url('IMG_1680.webp'));
$art_6 = lilychen_get_content('gallery_art_6', lilychen_image_url('IMG_1697.webp'));

// Activity options (Show King & Queen 2025)
$act_prefix    = lilychen_get_content('activity_prefix', 'Hoạt Động Thực Tế: Chung Kết');
$act_highlight = lilychen_get_content('activity_highlight', 'King & Queen 2025');
$act_sub       = lilychen_get_content('activity_sub', '(Đại Học Thủ Dầu Một)');
$act_desc      = lilychen_get_content('activity_desc', 'Master Lily Chen giữ vai trò Ban Giám Khảo Chuyên Môn cùng đội ngũ học viên tài trợ toàn bộ layout trang điểm cho thí sinh trong đêm chung kết.');
$act_img_1     = lilychen_get_content('activity_img_1', lilychen_image_url('lilychen-team-tdmu-2025.webp'));
$act_img_2     = lilychen_get_content('activity_img_2', lilychen_image_url('lilychen-tdmu-award-ceremony.webp'));
$act_img_3     = lilychen_get_content('activity_img_3', lilychen_image_url('lilychen-king-queen-collage-2025.webp'));

// Instructor options
$ins_img   = lilychen_get_content('instructor_image', lilychen_image_url('IMG_1683.webp'));
$ins_name  = lilychen_get_content('instructor_name', 'Master Lily Chen');
$ins_exp   = lilychen_get_content('instructor_exp', '6+');
$ins_bio   = lilychen_get_content('instructor_bio', 'Chào bạn, mình là Lily Chen (Nguyễn Phương Ly). Với hơn 6 năm gắn bó cùng nghề trang điểm tại TP. Thủ Dầu Một, Bình Dương, mình đã đồng hành và dẫn dắt hơn 200+ học viên — từ những bạn chưa từng biết cầm cây cọ đến khi tự tin làm chủ studio riêng hoặc làm đẹp cho chính bản thân mỗi ngày.');
$ins_quote = lilychen_get_content('instructor_quote', 'Đối với Lily, makeup không phải là biến bạn thành một con người xa lạ, mà là kỹ thuật tôn vinh những đường nét đẹp nhất vốn có trên gương mặt bạn. Dạy nghề bằng sự chân thành, cầm tay uốn nắn từng nét cọ, không giấu nghề.');

// Contact options
$hotline_display = lilychen_get_content('hotline_display', '088 997 97 91');
$hotline_tel     = lilychen_get_content('hotline_tel', '0889979791');

// Data structures
$courses      = lilychen_default_courses();
$gallery_items= lilychen_default_gallery_items();
$testimonials = lilychen_default_testimonials();
$faqs         = lilychen_default_faqs();
?>

  <main id="mainContent">

    <!-- ========================================================
         SECTION: HERO WITH AMBIENT 2D CANVAS & RHYTHMIC REVEAL
         ======================================================== -->
    <section class="hero-section proto-hero" id="hero">
      <!-- Fullscreen 2D Canvas Particle Field -->
      <canvas id="particleCanvas" class="particle-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>

      <div class="container hero-inner">
        <!-- Location Eyebrow -->
        <div class="hero-location">
          <span class="location-pulse" aria-hidden="true"></span>
          <span class="location-text"><?php echo esc_html($hero_location); ?></span>
        </div>

        <!-- Headline with Rhythmic Word Reveal -->
        <h1 class="hero-title" id="heroTitle">
          <span class="title-line title-line-1">
            <span class="reveal-word" style="--i: 0;">Đào</span>
            <span class="reveal-word" style="--i: 1;">tạo</span>
            <span class="reveal-word" style="--i: 2;">Makeup</span>
            <span class="word-group"><span class="reveal-word" style="--i: 3;">Chuyên</span> <span class="reveal-word" style="--i: 4;">nghiệp</span></span>
          </span>
          <span class="title-line title-line-2">
            <span class="reveal-word text-amp" style="--i: 5;">&amp;</span>
            <span class="reveal-word text-gradient-rose" style="--i: 6;">Cá</span>
            <span class="reveal-word text-gradient-rose" style="--i: 7;">nhân</span>
          </span>
        </h1>

        <!-- Direct Actions -->
        <div class="hero-actions">
          <a href="<?php echo esc_url($hero_cta1_url); ?>" class="btn-hero-primary" id="heroCtaPrimary">
            <span><?php echo esc_html($hero_cta1_text); ?></span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
          <a href="<?php echo esc_url($hero_cta2_url); ?>" class="btn-hero-secondary" id="heroCtaSecondary">
            <span><?php echo esc_html($hero_cta2_text); ?></span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M7 17l9.2-9.2M17 17V7H7"/>
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION: REAL PHOTO SHOWCASE MOSAIC (CLEAN REAL PHOTOS)
         ======================================================== -->
    <section class="proto-transition">
      <div class="container">
        <div class="transition-header">
          <div>
            <span class="section-kicker">Tác phẩm thực tế 100%</span>
            <h2 class="transition-title">Vẻ Đẹp Độc Bản Qua Từng Nét Cọ</h2>
          </div>
          <a href="<?php echo esc_url(home_url('/tac-pham-hoc-vien/')); ?>" class="transition-link">
            <span>Khám phá bộ sưu tập tác phẩm</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>

        <!-- Clean Photos Mosaic: Zero Text on Photos -->
        <div class="photo-mosaic">
          <div class="photo-card">
            <img src="<?php echo esc_url($mosaic_1); ?>" alt="Tác phẩm makeup cô dâu tone cam đào trong trẻo của học viên Lily Chen" class="photo-asset" loading="lazy">
          </div>
          <div class="photo-card">
            <img src="<?php echo esc_url($mosaic_2); ?>" alt="Layout makeup Douyin bọng mắt tự nhiên" class="photo-asset" loading="lazy">
          </div>
          <div class="photo-card">
            <img src="<?php echo esc_url($mosaic_3); ?>" alt="Layout cô dâu phong cách truyền thống sang trọng" class="photo-asset" loading="lazy">
          </div>
          <div class="photo-card">
            <img src="<?php echo esc_url($mosaic_4); ?>" alt="Tác phẩm trang điểm dự tiệc thanh lịch" class="photo-asset" loading="lazy">
          </div>
          <div class="photo-card">
            <img src="<?php echo esc_url($mosaic_5); ?>" alt="Layout makeup cá nhân tự nhiên 10 phút" class="photo-asset" loading="lazy">
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION: CÁC KHÓA ĐÀO TẠO (BỐ CỤC MỞ & HẠT TƯƠNG TÁC)
         ======================================================== -->
    <div class="courses-interactive-cluster" id="coursesInteractiveCluster">
      <!-- Section Header -->
      <div class="container courses-cluster-header">
        <span class="section-kicker">Chương Trình Đào Tạo Thực Chiến</span>
        <h2 class="section-title">Khóa Học Tuyển Sinh</h2>
      </div>

      <!-- COURSE 1: KHÓA MAKEUP CHUYÊN NGHIỆP (TOP) -->
      <?php $c_pro = $courses['pro']; ?>
      <section class="course-open-section" id="khoa-hoc" data-course-id="pro" aria-labelledby="courseTitlePro">
        <span id="khoa-chuyen-nghiep" class="section-anchor" aria-hidden="true"></span>
        <canvas id="courseMorphCanvasPro" class="course-morph-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
        <div class="container">
          <div class="course-open-grid">
            <!-- Content Column -->
            <div class="course-open-content">
              <div class="course-open-eyebrow">
                <span class="course-pill-featured"><?php echo esc_html($c_pro['pill']); ?></span>
                <span class="course-target-text"><?php echo wp_kses_post($c_pro['target']); ?></span>
              </div>
              <h3 class="course-open-name" id="courseTitlePro"><?php echo esc_html($c_pro['name']); ?></h3>
              <p class="course-open-summary">
                <?php echo esc_html($pro_summary); ?>
              </p>

              <!-- Tuition Info -->
              <div class="course-open-pricing">
                <div class="price-figure"><?php echo esc_html($pro_price); ?></div>
                <div class="price-context">
                  <span class="price-title"><?php echo esc_html($c_pro['price_title']); ?></span>
                  <span class="price-sub"><?php echo esc_html($pro_price_sub); ?></span>
                </div>
              </div>

              <!-- Open Specs Row -->
              <div class="course-open-specs-bar">
                <?php foreach ($c_pro['specs'] as $index => $spec) : ?>
                  <?php if ($index > 0) : ?><div class="spec-unit-divider"></div><?php endif; ?>
                  <div class="spec-unit">
                    <span class="spec-unit-label"><?php echo esc_html($spec['label']); ?></span>
                    <span class="spec-unit-val"><?php echo esc_html($spec['value']); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Highlights List -->
              <ul class="course-open-highlights">
                <?php foreach ($c_pro['highlights'] as $hl) : ?>
                <li>
                  <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                  <span><?php echo wp_kses_post($hl); ?></span>
                </li>
                <?php endforeach; ?>
              </ul>

              <!-- Action Link -->
              <div class="course-open-action" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="<?php echo esc_url($c_pro['detail_link']); ?>" class="btn btn-primary btn-lg course-focus-link">
                  <span>Xem Chi Tiết Khóa Chuyên Nghiệp</span>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#dang-ky" class="btn btn-secondary btn-lg">
                  <span>Đăng Ký Tư Vấn</span>
                </a>
              </div>
            </div>

            <!-- Authentic Media Column -->
            <div class="course-open-visual">
              <div class="course-open-photo-wrap">
                <img src="<?php echo esc_url($pro_img); ?>" alt="<?php echo esc_attr($c_pro['image_alt']); ?>" class="course-open-photo" loading="lazy">
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- COURSE 2: KHÓA TRANG ĐIỂM CÁ NHÂN (BOTTOM) -->
      <?php $c_personal = $courses['personal']; ?>
      <section class="course-open-section" id="khoa-ca-nhan" data-course-id="personal" aria-labelledby="courseTitlePersonal">
        <canvas id="courseMorphCanvasPersonal" class="course-morph-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
        <div class="container">
          <div class="course-open-grid reverse">
            <!-- Content Column -->
            <div class="course-open-content">
              <div class="course-open-eyebrow">
                <span class="course-pill-personal"><?php echo esc_html($c_personal['pill']); ?></span>
                <span class="course-target-text"><?php echo wp_kses_post($c_personal['target']); ?></span>
              </div>
              <h3 class="course-open-name" id="courseTitlePersonal"><?php echo esc_html($c_personal['name']); ?></h3>
              <p class="course-open-summary">
                <?php echo esc_html($per_summary); ?>
              </p>

              <!-- Tuition Info -->
              <div class="course-open-pricing">
                <div class="price-figure"><?php echo esc_html($per_price); ?></div>
                <div class="price-context">
                  <span class="price-title"><?php echo esc_html($c_personal['price_title']); ?></span>
                  <span class="price-sub"><?php echo esc_html($per_price_sub); ?></span>
                </div>
              </div>

              <!-- Open Specs Row -->
              <div class="course-open-specs-bar">
                <?php foreach ($c_personal['specs'] as $index => $spec) : ?>
                  <?php if ($index > 0) : ?><div class="spec-unit-divider"></div><?php endif; ?>
                  <div class="spec-unit">
                    <span class="spec-unit-label"><?php echo esc_html($spec['label']); ?></span>
                    <span class="spec-unit-val"><?php echo esc_html($spec['value']); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Highlights List -->
              <ul class="course-open-highlights">
                <?php foreach ($c_personal['highlights'] as $hl) : ?>
                <li>
                  <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                  <span><?php echo wp_kses_post($hl); ?></span>
                </li>
                <?php endforeach; ?>
              </ul>

              <!-- Action Link -->
              <div class="course-open-action" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="<?php echo esc_url($c_personal['detail_link']); ?>" class="btn btn-secondary btn-lg course-focus-link">
                  <span>Xem Chi Tiết Khóa Cá Nhân</span>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#dang-ky" class="btn btn-primary btn-lg">
                  <span>Đăng Ký Tư Vấn</span>
                </a>
              </div>
            </div>

            <!-- Authentic Media Column -->
            <div class="course-open-visual">
              <div class="course-open-photo-wrap">
                <img src="<?php echo esc_url($per_img); ?>" alt="<?php echo esc_attr($c_personal['image_alt']); ?>" class="course-open-photo" loading="lazy">
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- ========================================================
         SECTION 7: TÁC PHẨM HỌC VIÊN & HOẠT ĐỘNG THỰC TẾ
         ======================================================== -->
    <section class="section-padding gallery-section" id="tac-pham">
      <div class="container">
        <!-- Section Header -->
        <div class="section-header">
          <h2 class="section-title">Tác Phẩm Học Viên</h2>
        </div>

        <!-- Category Filters -->
        <div class="gallery-filters" role="tablist" aria-label="Bộ lọc tác phẩm">
          <button type="button" class="gallery-filter-btn active" data-filter="all">Tất Cả Tác Phẩm</button>
          <button type="button" class="gallery-filter-btn" data-filter="codau">Makeup Cô Dâu</button>
          <button type="button" class="gallery-filter-btn" data-filter="tiec">Dự Tiệc &amp; Kỷ Yếu</button>
          <button type="button" class="gallery-filter-btn" data-filter="douyin">Douyin &amp; Cá Nhân</button>
        </div>

        <!-- Gallery Grid (6 Items) -->
        <div class="gallery-grid" id="galleryGrid">
          <div class="gallery-item" data-category="codau">
            <img src="<?php echo esc_url($art_1); ?>" alt="Tác phẩm makeup cô dâu tone trong trẻo của học viên Lily Chen" class="gallery-img" loading="lazy">
          </div>
          <div class="gallery-item" data-category="tiec">
            <img src="<?php echo esc_url($art_2); ?>" alt="Tác phẩm trang điểm dự tiệc sang trọng của học viên" class="gallery-img" loading="lazy">
          </div>
          <div class="gallery-item" data-category="douyin">
            <img src="<?php echo esc_url($art_3); ?>" alt="Trang điểm phong cách Douyin nhẹ nhàng thanh thuần" class="gallery-img" loading="lazy">
          </div>
          <div class="gallery-item" data-category="douyin">
            <img src="<?php echo esc_url($art_4); ?>" alt="Kỹ thuật che khuyết điểm da và eyeliner sắc nét" class="gallery-img" loading="lazy">
          </div>
          <div class="gallery-item" data-category="codau">
            <img src="<?php echo esc_url($art_5); ?>" alt="Tác phẩm bài thi tốt nghiệp khóa chuyên nghiệp" class="gallery-img" loading="lazy">
          </div>
          <div class="gallery-item" data-category="tiec">
            <img src="<?php echo esc_url($art_6); ?>" alt="Trang điểm kỷ yếu thanh xuân tự nhiên" class="gallery-img" loading="lazy">
          </div>
        </div>

        <!-- Section CTA: Link to Portfolio Page -->
        <div class="gallery-cta-wrap" style="text-align: center; margin: 36px 0 52px;">
          <a href="<?php echo esc_url(home_url('/tac-pham-hoc-vien/')); ?>" class="btn btn-secondary btn-lg" style="box-shadow: 0 4px 18px rgba(212, 83, 122, 0.15);">
            <span>Xem Thêm Tác Phẩm Học Viên</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>

        <!-- Real Activity Highlight Card: TDMU King & Queen 2025 -->
        <div class="activity-card">
          <div class="activity-info">
            <h3 class="activity-title">
              <?php echo esc_html($act_prefix); ?> <span class="text-gradient"><?php echo esc_html($act_highlight); ?></span> <?php echo esc_html($act_sub); ?>
            </h3>
            <p class="activity-desc">
              <?php echo esc_html($act_desc); ?>
            </p>
          </div>

          <!-- Activity Photos Mosaic -->
          <div class="activity-mosaic">
            <div class="activity-img-wrap">
              <img src="<?php echo esc_url($act_img_1); ?>" alt="Đội ngũ Lily Chen Makeup Academy tại đêm chung kết King & Queen Đại học Thủ Dầu Một" loading="lazy">
            </div>
            <div class="activity-img-wrap">
              <img src="<?php echo esc_url($act_img_2); ?>" alt="Master Lily Chen trao giải trên sân khấu King & Queen 2025" loading="lazy">
            </div>
            <div class="activity-img-wrap">
              <img src="<?php echo esc_url($act_img_3); ?>" alt="Các layout trang điểm thí sinh King & Queen do Lily Chen thực hiện" loading="lazy">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION 8: MASTER LILY CHEN (E-E-A-T INSTRUCTOR)
         ======================================================== -->
    <section class="section-padding instructor-section" id="giang-vien">
      <div class="container">
        <div class="instructor-grid">
          <!-- Left Column: Instructor Portrait Frame -->
          <div class="instructor-visual">
            <div class="instructor-frame">
              <img src="<?php echo esc_url($ins_img); ?>" alt="<?php echo esc_attr($ins_name); ?> - Giảng viên sáng lập Lily Chen Makeup Academy" class="instructor-photo" loading="lazy">
              <!-- Experience Floating Badge -->
              <div class="instructor-badge-exp">
                <span class="exp-number"><?php echo esc_html($ins_exp); ?></span>
                <div class="exp-label">
                  Năm Kinh Nghiệm<br>
                  <strong style="color: var(--color-primary-light);">Đào Tạo Thực Chiến</strong>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column: Story & Philosophy -->
          <div class="instructor-content">
            <span class="instructor-subtitle">Người Sáng Lập &amp; Giảng Viên Trực Tiếp</span>
            <h2 class="instructor-name"><?php echo esc_html($ins_name); ?></h2>
            
            <p class="instructor-bio">
              <?php echo wp_kses_post($ins_bio); ?>
            </p>

            <!-- Personal Philosophy Quote -->
            <div class="instructor-quote">
              "<?php echo esc_html($ins_quote); ?>"
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION 9: CẢM NHẬN HỌC VIÊN ĐÃ TỐT NGHIỆP
         ======================================================== -->
    <section class="section-padding testimonials-section" id="cam-nhan">
      <div class="container">
        <!-- Section Header -->
        <div class="section-header">
          <h2 class="section-title">Cảm Nhận Học Viên</h2>
        </div>

        <!-- 3 Testimonial Cards Grid -->
        <div class="testimonials-grid">
          <?php foreach ($testimonials as $tidx => $t) : 
            $tnum = $tidx + 1;
            $tname = lilychen_get_content('testimonial_name_' . $tnum, $t['name']);
            $tgrad = lilychen_get_content('testimonial_grad_' . $tnum, $t['course'] . ' · ' . $t['grad']);
            $tquote = lilychen_get_content('testimonial_quote_' . $tnum, $t['quote']);
            $tavatar = lilychen_get_content('testimonial_avatar_' . $tnum, lilychen_image_url($t['avatar']));
          ?>
          <div class="testimonial-card">
            <div>
              <div class="testimonial-stars" aria-label="5 trên 5 sao">
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
              </div>
              <p class="testimonial-quote">
                <?php echo esc_html($tquote); ?>
              </p>
            </div>
            <div class="testimonial-author">
              <img src="<?php echo esc_url($tavatar); ?>" alt="<?php echo esc_attr($tname); ?>" class="author-avatar" loading="lazy">
              <div class="author-info">
                <span class="author-name"><?php echo esc_html($tname); ?></span>
                <span class="author-grad"><?php echo esc_html($tgrad); ?></span>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Rating Summary Pill -->
        <div class="testimonials-summary">
          <span class="summary-score">4.9 / 5.0 ⭐</span>
          <span class="summary-text">Điểm đánh giá trung bình từ <strong>200+ học viên</strong> trên Google &amp; Facebook</span>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION: BLOG & KIẾN THỨC MAKEUP (LATEST POSTS)
         ======================================================== -->
    <section class="section-padding blog-section" id="blog" aria-labelledby="blogHeading">
      <div class="container">
        <!-- Section Header -->
        <div class="section-header">
          <h2 id="blogHeading" class="section-title">Blog &amp; Kiến Thức</h2>
        </div>

        <!-- Blog Cards Grid -->
        <div class="blog-grid">
          <?php
          // Query 3 latest posts from WordPress database if available
          $latest_posts = new WP_Query(array(
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'post_status'    => 'publish',
          ));

          if ($latest_posts->have_posts()) :
              while ($latest_posts->have_posts()) : $latest_posts->the_post();
                  $categories = get_the_category();
                  $cat_name   = !empty($categories) ? $categories[0]->name : 'Kiến thức Makeup';
                  ?>
                  <article class="blog-card">
                    <div class="blog-thumb-wrap">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large', array('class' => 'blog-thumb', 'loading' => 'lazy')); ?>
                      <?php else : ?>
                        <img src="<?php echo esc_url(lilychen_image_url('nghe-makeup-co-tuong-lai-khong-featured.webp')); ?>" alt="<?php the_title_attribute(); ?>" class="blog-thumb" width="1200" height="675" loading="lazy">
                      <?php endif; ?>
                      <span class="blog-cat-badge"><?php echo esc_html($cat_name); ?></span>
                    </div>
                    <div class="blog-content">
                      <div class="blog-meta">
                        <span class="blog-date"><?php echo esc_html(get_the_date('d \T\h\á\n\g m, Y')); ?></span>
                        <span class="blog-dot">·</span>
                        <span class="blog-author"><?php the_author(); ?></span>
                      </div>
                      <h3 class="blog-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h3>
                      <p class="blog-excerpt">
                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24, '...')); ?>
                      </p>
                      <div class="blog-footer">
                        <a href="<?php the_permalink(); ?>" class="blog-read-more">
                          <span>Đọc tiếp</span>
                          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                      </div>
                    </div>
                  </article>
                  <?php
              endwhile;
              wp_reset_postdata();
          else :
              // Fallback cards from original index.html if database has no posts yet
              ?>
              <!-- Fallback Post 1 -->
              <article class="blog-card">
                <div class="blog-thumb-wrap">
                  <img src="<?php echo esc_url(lilychen_image_url('nghe-makeup-co-tuong-lai-khong-featured.webp')); ?>" alt="Nghề makeup có tương lai không? Lộ trình &amp; góc nhìn thu nhập cho người mới" class="blog-thumb" width="1200" height="675" loading="lazy">
                  <span class="blog-cat-badge">Định Hướng Nghề</span>
                </div>
                <div class="blog-content">
                  <div class="blog-meta">
                    <span class="blog-date">05 Tháng 6, 2026</span>
                    <span class="blog-dot">·</span>
                    <span class="blog-author">Master Lily Chen</span>
                  </div>
                  <h3 class="blog-title">
                    <a href="<?php echo esc_url(home_url('/nghe-makeup-co-tuong-lai-khong/')); ?>">Nghề Makeup Có Tương Lai Không? Lộ Trình &amp; Góc Nhìn Thu Nhập Cho Người Mới</a>
                  </h3>
                  <p class="blog-excerpt">
                    Phân tích nhu cầu ngành làm đẹp hiện nay, các khoảng thu nhập tham khảo và tầm quan trọng của việc rèn luyện tay nghề thực tế trên mẫu thật cho học viên mới bắt đầu.
                  </p>
                  <div class="blog-footer">
                    <a href="<?php echo esc_url(home_url('/nghe-makeup-co-tuong-lai-khong/')); ?>" class="blog-read-more">
                      <span>Đọc tiếp</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Fallback Post 2 -->
              <article class="blog-card">
                <div class="blog-thumb-wrap">
                  <img src="<?php echo esc_url(lilychen_image_url('Nang-cong-so-makeup-di-lam-nhe-nhang-tu-nhien-1192x800.webp')); ?>" alt="Cách makeup đi làm nhẹ nhàng trong 10 phút cho nàng công sở" class="blog-thumb" loading="lazy" width="600" height="400">
                  <span class="blog-cat-badge">Makeup Cá Nhân</span>
                </div>
                <div class="blog-content">
                  <div class="blog-meta">
                    <span class="blog-date">10 Tháng 6, 2026</span>
                    <span class="blog-dot">·</span>
                    <span class="blog-author">Master Lily Chen</span>
                  </div>
                  <h3 class="blog-title">
                    <a href="<?php echo esc_url(home_url('/cach-makeup-di-lam-10-phut/')); ?>">Cách Makeup Đi Làm Nhẹ Nhàng Trong 10 Phút Cho Nàng Công Sở</a>
                  </h3>
                  <p class="blog-excerpt">
                    Quy trình từng phút tối giản cho buổi sáng bận rộn: giữ nền mỏng nhẹ, không mốc khi ngồi phòng máy lạnh và luôn tươi tắn chuẩn thanh lịch.
                  </p>
                  <div class="blog-footer">
                    <a href="<?php echo esc_url(home_url('/cach-makeup-di-lam-10-phut/')); ?>" class="blog-read-more">
                      <span>Đọc tiếp</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                  </div>
                </div>
              </article>

              <!-- Fallback Post 3 -->
              <article class="blog-card">
                <div class="blog-thumb-wrap">
                  <img src="<?php echo esc_url(lilychen_image_url('makeup-che-khuyet-diem-e1781457352881-2048x1246.webp')); ?>" alt="Bí quyết makeup che khuyết điểm da dầu mụn không bị mốc" class="blog-thumb" loading="lazy" width="600" height="400">
                  <span class="blog-cat-badge">Kỹ Thuật Nền 3D</span>
                </div>
                <div class="blog-content">
                  <div class="blog-meta">
                    <span class="blog-date">05 Tháng 6, 2026</span>
                    <span class="blog-dot">·</span>
                    <span class="blog-author">Master Lily Chen</span>
                  </div>
                  <h3 class="blog-title">
                    <a href="<?php echo esc_url(home_url('/che-khuyet-diem-da-mun-da-dau/')); ?>">Makeup Che Khuyết Điểm Da Mụn, Da Dầu: Cách Lên Nền Không Mốc, Không Trôi</a>
                  </h3>
                  <p class="blog-excerpt">
                    Kỹ thuật dặm mút và chọn kem lót kiềm dầu chuẩn chuyên nghiệp, giúp che giấu mụn đỏ và lỗ chân lông to mà da vẫn căng mướt tự nhiên suốt 8 tiếng.
                  </p>
                  <div class="blog-footer">
                    <a href="<?php echo esc_url(home_url('/che-khuyet-diem-da-mun-da-dau/')); ?>" class="blog-read-more">
                      <span>Đọc tiếp</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                  </div>
                </div>
              </article>
              <?php
          endif;
          ?>
        </div>

        <!-- Section CTA Link to Blog -->
        <div class="blog-cta-wrap" style="text-align: center; margin-top: 45px;">
          <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn-secondary btn-lg" style="box-shadow: 0 4px 18px rgba(212, 83, 122, 0.15);">
            <span>Đọc Thêm Các Bài Viết Khác</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION 10: CÂU HỎI THƯỜNG GẶP (FAQ ACCORDION)
         ======================================================== -->
    <section id="faq" class="section-padding faq-section" aria-labelledby="faqHeading">
      <div class="container faq-container">
        <div class="section-header">
          <h2 id="faqHeading" class="section-title">Câu Hỏi Thường Gặp</h2>
        </div>

        <div class="faq-accordion" role="region" aria-label="Danh sách câu hỏi thường gặp">
          <?php foreach ($faqs as $idx => $faq) : 
            $fnum = $idx + 1;
            $fq = lilychen_get_content('faq_q_' . $fnum, $faq['q']);
            $fa = lilychen_get_content('faq_a_' . $fnum, $faq['a']);
          ?>
          <div class="faq-item" id="faq-item-<?php echo esc_attr($fnum); ?>">
            <button class="faq-question" type="button" aria-expanded="false" aria-controls="faq-ans-<?php echo esc_attr($fnum); ?>">
              <span><?php echo esc_html($fq); ?></span>
              <span class="faq-toggle-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/></svg>
              </span>
            </button>
            <div id="faq-ans-<?php echo esc_attr($fnum); ?>" class="faq-answer" role="region">
              <p><?php echo wp_kses_post($fa); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SECTION 11: FINAL CONVERSION & FORM ĐĂNG KÝ LEAD
         ======================================================== -->
    <section id="dang-ky" class="section-padding conversion-section" aria-labelledby="conversionHeading">
      <div class="container">
        <div class="conversion-grid">
          <!-- Left Column: Direct Consultation Info -->
          <div class="conversion-info">
            <h2 id="conversionHeading" class="conversion-title">Đăng Ký Tư Vấn</h2>
            <p class="conversion-desc">Để lại thông tin để nhận tư vấn chi tiết về lộ trình học phù hợp với nhu cầu và định hướng của bạn.</p>

            <div class="conversion-direct">
              <div class="conversion-direct-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--color-primary)"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.24.2 2.45.57 3.57a1 1 0 01-.25 1.02l-2.2 2.2z"/></svg>
              </div>
              <div class="conversion-direct-text">
                <span>Trao đổi trực tiếp qua điện thoại hoặc Zalo:</span>
                <strong>Hotline: <a href="tel:<?php echo esc_attr($hotline_tel); ?>" style="color: inherit;"><?php echo esc_html($hotline_display); ?></a></strong>
              </div>
            </div>
          </div>

          <!-- Right Column: Interactive Lead Form -->
          <div class="lead-form-card">
            <div class="lead-form-header">
              <h3 class="lead-form-title">Đăng Ký Tư Vấn Lộ Trình</h3>
              <p class="lead-form-sub">Nhận phân tích phong cách trang điểm &amp; bảng học phí</p>
            </div>

            <!-- PROTOTYPE TEST MODE NOTICE -->
            <div class="form-test-mode-banner" role="note">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink: 0; margin-top: 2px;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
              <div>
                <span class="form-test-mode-badge">Bản Mẫu Thử Nghiệm</span>
                <strong>Tính năng gửi dữ liệu đang tạm tắt:</strong> Đây là bản mẫu duyệt giao diện trên Staging. Thao tác gửi form sẽ mô phỏng phản hồi tại chỗ mà không gọi API bên ngoài hay kích hoạt email thật.
              </div>
            </div>

            <form id="leadForm" class="lead-form" novalidate>
              <!-- Hidden Security & Honeypot Fields -->
              <input type="text" name="_hp_company" style="display:none !important;" tabindex="-1" autocomplete="off">
              <input type="hidden" name="_form_load_time" value="<?php echo esc_attr(time()); ?>">
              <input type="hidden" name="source_page" value="<?php echo esc_attr(get_permalink()); ?>">

              <div class="form-group">
                <label for="leadName" class="form-label">Họ và tên của bạn <span>*</span></label>
                <input type="text" id="leadName" name="name" class="form-control" placeholder="Ví dụ: Nguyễn Thùy Linh" required>
              </div>

              <div class="form-group">
                <label for="leadPhone" class="form-label">Số điện thoại / Zalo <span>*</span></label>
                <input type="tel" id="leadPhone" name="phone" class="form-control" placeholder="Ví dụ: 0987 654 321" required>
              </div>

              <div class="form-group">
                <label for="leadCourse" class="form-label">Khóa học bạn quan tâm <span>*</span></label>
                <select id="leadCourse" name="course" class="form-control" required>
                  <option value="" disabled selected>-- Chọn khóa học bạn muốn tư vấn --</option>
                  <option value="Khóa Cá Nhân 4 Buổi">Khóa Trang Điểm Cá Nhân (4 Buổi - Từ 1.500.000đ)</option>
                  <option value="Khóa Chuyên Nghiệp 3 Tháng">Khóa Trang Điểm Chuyên Nghiệp (3 Tháng - Ưu Đãi 25.000.000đ)</option>
                  <option value="Khóa Cô Dâu Nâng Cao">Khóa Chuyên Sâu Cô Dâu &amp; Dự Tiệc Cao Cấp</option>
                  <option value="Tư Vấn Chọn Khóa Phù Hợp">Tôi cần Master Lily Chen tư vấn chọn khóa phù hợp</option>
                </select>
              </div>

              <div class="form-group">
                <label for="leadTime" class="form-label">Khung giờ học mong muốn</label>
                <select id="leadTime" name="time" class="form-control">
                  <option value="Linh hoạt">Linh hoạt theo lịch rảnh của tôi</option>
                  <option value="Ca Sáng (09:00 - 11:30)">Ca Sáng (09:00 - 11:30)</option>
                  <option value="Ca Chiều (14:00 - 16:30)">Ca Chiều (14:00 - 16:30)</option>
                  <option value="Ca Tối (18:00 - 20:30)">Ca Tối (18:00 - 20:30 - Thích hợp văn phòng)</option>
                  <option value="Cuối tuần (Thứ 7 - CN)">Học vào các ngày cuối tuần (Thứ 7 - CN)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="leadMessage" class="form-label">Ghi chú hoặc mong muốn của bạn</label>
                <textarea id="leadMessage" name="message" class="form-control" rows="3" placeholder="Ví dụ: Da mình nhiều dầu, chưa biết kẻ mắt, muốn học để tự tin đi làm..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-lg form-submit-btn">
                GỬI ĐĂNG KÝ TƯ VẤN (THỬ NGHIỆM)
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
              </button>

              <div class="form-privacy-note">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                Thông tin được bảo mật tuyệt đối theo <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>" style="color: inherit; text-decoration: underline;">Chính sách bảo mật</a>. Master Lily Chen sẽ liên hệ trong 24 giờ.
              </div>

              <!-- Success Notification Box -->
              <div id="formSuccessMsg" class="form-success-msg" role="status" aria-live="polite">
                🎉 <strong>Đăng ký thành công!</strong> Cảm ơn bạn <span id="successUserName"></span>. Master Lily Chen đã nhận được thông tin và sẽ gọi điện tư vấn lộ trình chi tiết cho bạn qua số điện thoại <span id="successUserPhone"></span> trong ít phút tới!
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
