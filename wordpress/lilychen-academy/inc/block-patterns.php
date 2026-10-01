<?php
/**
 * Block Patterns Registration for Lily Chen Academy Theme
 * Provides 9 reusable Gutenberg layouts using real core blocks:
 * heading, paragraph, image, buttons, columns, group, list, quote.
 * Allows editors to visually edit text, replace images, and change links without touching HTML.
 * Content is persisted in WordPress database (post_content) and survives theme updates.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

function lilychen_register_block_patterns() {
    // 1. Register Pattern Category
    register_block_pattern_category('lilychen-patterns', array(
        'label' => __('Lily Chen Academy', 'lilychen-academy'),
    ));

    $img_dir = get_template_directory_uri() . '/assets/images/';

    // -------------------------------------------------------------------------
    // 1. Pattern: Hero Section
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/hero-section', array(
        'title'       => __('Hero - Khối Đầu Trang', 'lilychen-academy'),
        'description' => __('Khối mở đầu trang với vị trí, tiêu đề lớn và 2 nút kêu gọi hành động', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"hero-section proto-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group hero-section proto-hero"><div class="container hero-inner">
  <!-- wp:paragraph {"className":"hero-location location-text"} -->
  <p class="hero-location location-text">Thủ Dầu Một · Bình Dương</p>
  <!-- /wp:paragraph -->
  <!-- wp:heading {"level":1,"className":"hero-title"} -->
  <h1 class="wp-block-heading hero-title">Đào tạo Makeup Chuyên nghiệp &amp; Cá nhân</h1>
  <!-- /wp:heading -->
  <!-- wp:buttons {"className":"hero-actions"} -->
  <div class="wp-block-buttons hero-actions">
    <!-- wp:button {"className":"btn-hero-primary"} -->
    <div class="wp-block-button btn-hero-primary"><a class="wp-block-button__link wp-element-button" href="' . esc_url(home_url('/#khoa-hoc')) . '">Xem khóa học</a></div>
    <!-- /wp:button -->
    <!-- wp:button {"className":"btn-hero-secondary"} -->
    <div class="wp-block-button btn-hero-secondary"><a class="wp-block-button__link wp-element-button" href="' . esc_url(home_url('/portfolio/')) . '">Xem tác phẩm</a></div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 2. Pattern: Course Professional
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/course-pro', array(
        'title'       => __('Khóa Makeup Chuyên Nghiệp', 'lilychen-academy'),
        'description' => __('Bố cục 2 cột giới thiệu Khóa Chuyên Nghiệp kèm thông số, học phí và ảnh đại diện', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"course-open-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group course-open-section"><div class="container">
  <!-- wp:columns {"className":"course-open-grid"} -->
  <div class="wp-block-columns course-open-grid">
    <!-- wp:column {"width":"60%","className":"course-open-content"} -->
    <div class="wp-block-column course-open-content" style="flex-basis:60%">
      <!-- wp:paragraph {"className":"course-pill-featured"} -->
      <p class="course-pill-featured">Khóa Học Tiêu Biểu · Dành cho bạn muốn học nghề &amp; tự chủ tài chính</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":3,"className":"course-open-name"} -->
      <h3 class="wp-block-heading course-open-name">Khóa Makeup Chuyên Nghiệp</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"className":"course-open-summary"} -->
      <p class="course-open-summary">Đào tạo nghề toàn diện cho người muốn trở thành Makeup Artist tự do, làm việc tại bridal studio hoặc tự mở tiệm trang điểm. 90% thực hành mẫu thật dưới sự kèm cặp 1-1 trực tiếp của Master Lily Chen.</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":4,"className":"price-figure"} -->
      <h4 class="wp-block-heading price-figure">25.000.000đ</h4>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"className":"price-sub"} -->
      <p class="price-sub">Học phí trọn gói · Hỗ trợ trả góp linh hoạt 2–3 đợt · Tặng bộ cọ chuyên nghiệp cao cấp</p>
      <!-- /wp:paragraph -->
      <!-- wp:list {"className":"course-open-highlights"} -->
      <ul class="wp-block-list course-open-highlights">
        <!-- wp:list-item --><li>Thời lượng: 3 tháng thực chiến · Thực hành: 90% trên mẫu thật · Sĩ số: Tối đa 5 học viên</li><!-- /wp:list-item -->
        <!-- wp:list-item --><li>Làm chủ toàn bộ layout: Cô dâu cao cấp, Dạ tiệc, Kỷ yếu &amp; Douyin hot trend</li><!-- /wp:list-item -->
        <!-- wp:list-item --><li>Xử lý chuyên sâu da khuyết điểm, tạo khối 3D &amp; làm tóc đồng bộ theo layout</li><!-- /wp:list-item -->
        <!-- wp:list-item --><li>Thi tốt nghiệp, cấp chứng chỉ &amp; hướng dẫn chụp ảnh, set up ánh sáng nhận khách 1:1</li><!-- /wp:list-item -->
      </ul>
      <!-- /wp:list -->
      <!-- wp:buttons -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"btn btn-primary btn-lg"} -->
        <div class="wp-block-button btn btn-primary btn-lg"><a class="wp-block-button__link wp-element-button" href="' . esc_url(home_url('/#dang-ky')) . '">Đăng Ký Tư Vấn</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"width":"40%","className":"course-open-visual"} -->
    <div class="wp-block-column course-open-visual" style="flex-basis:40%">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"course-open-photo"} -->
      <figure class="wp-block-image size-large course-open-photo"><img src="' . esc_url($img_dir . 'lilychen-king-queen-collage-2025.webp') . '" alt="Khóa đào tạo makeup chuyên nghiệp"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 3. Pattern: Course Personal
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/course-personal', array(
        'title'       => __('Khóa Trang Điểm Cá Nhân', 'lilychen-academy'),
        'description' => __('Bố cục 2 cột giới thiệu Khóa Cá Nhân kèm lịch học linh hoạt và ảnh đại diện', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"course-open-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group course-open-section"><div class="container">
  <!-- wp:columns {"className":"course-open-grid reverse"} -->
  <div class="wp-block-columns course-open-grid reverse">
    <!-- wp:column {"width":"60%","className":"course-open-content"} -->
    <div class="wp-block-column course-open-content" style="flex-basis:60%">
      <!-- wp:paragraph {"className":"course-pill-personal"} -->
      <p class="course-pill-personal">Làm Đẹp Cá Nhân · Dành cho cá nhân, học sinh sinh viên &amp; người đi làm</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":3,"className":"course-open-name"} -->
      <h3 class="wp-block-heading course-open-name">Khóa Trang Điểm Cá Nhân</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"className":"course-open-summary"} -->
      <p class="course-open-summary">Tự tin trang điểm nhẹ nhàng, tôn nét tự nhiên chỉ sau 10–15 phút mỗi sáng và làm chủ layout dự tiệc thanh lịch, không phụ thuộc tiệm. Giáo trình cá nhân hóa theo từng dáng mặt.</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":4,"className":"price-figure"} -->
      <h4 class="wp-block-heading price-figure">Từ 1.500.000đ</h4>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"className":"price-sub"} -->
      <p class="price-sub">Học phí trọn gói · Mỹ phẩm &amp; dụng cụ thực hành được chuẩn bị sẵn 100% tại lớp</p>
      <!-- /wp:paragraph -->
      <!-- wp:list {"className":"course-open-highlights"} -->
      <ul class="wp-block-list course-open-highlights">
        <!-- wp:list-item --><li>Thời lượng: 4 buổi chuyên sâu · Sĩ số: Tối đa 5 người · Lịch học: Linh hoạt T2–CN</li><!-- /wp:list-item -->
        <!-- wp:list-item --><li>Nhận diện đặc điểm khuôn mặt &amp; chọn mỹ phẩm đúng tone da, tránh lãng phí</li><!-- /wp:list-item -->
        <!-- wp:list-item --><li>Kỹ thuật tán nền mỏng mịn glass-skin, kiềm dầu và chống mốc cakey cả ngày</li><!-- /wp:list-item -->
        <!-- wp:list-item --><li>Makeup đi làm nhẹ nhàng 10 phút &amp; layout dự tiệc sang trọng, cuốn hút</li><!-- /wp:list-item -->
      </ul>
      <!-- /wp:list -->
      <!-- wp:buttons -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"btn btn-primary btn-lg"} -->
        <div class="wp-block-button btn btn-primary btn-lg"><a class="wp-block-button__link wp-element-button" href="' . esc_url(home_url('/#dang-ky')) . '">Đăng Ký Tư Vấn</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"width":"40%","className":"course-open-visual"} -->
    <div class="wp-block-column course-open-visual" style="flex-basis:40%">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"course-open-photo"} -->
      <figure class="wp-block-image size-large course-open-photo"><img src="' . esc_url($img_dir . 'IMG_1646.webp') . '" alt="Khóa trang điểm cá nhân"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 4. Pattern: Instructor Bio E-E-A-T
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/instructor-bio', array(
        'title'       => __('Giảng Viên Master Lily Chen', 'lilychen-academy'),
        'description' => __('Khối giới thiệu người sáng lập kèm chân dung, số năm kinh nghiệm và triết lý đào tạo', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"section-padding instructor-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group section-padding instructor-section"><div class="container">
  <!-- wp:columns {"className":"instructor-grid"} -->
  <div class="wp-block-columns instructor-grid">
    <!-- wp:column {"width":"35%","className":"instructor-visual"} -->
    <div class="wp-block-column instructor-visual" style="flex-basis:35%">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"instructor-photo"} -->
      <figure class="wp-block-image size-large instructor-photo"><img src="' . esc_url($img_dir . 'IMG_1683.webp') . '" alt="Master Lily Chen"/></figure>
      <!-- /wp:image -->
      <!-- wp:paragraph {"className":"instructor-badge-exp"} -->
      <p class="instructor-badge-exp"><strong>6+ Năm Kinh Nghiệm</strong> · Đào Tạo Thực Chiến</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"width":"65%","className":"instructor-content"} -->
    <div class="wp-block-column instructor-content" style="flex-basis:65%">
      <!-- wp:paragraph {"className":"instructor-subtitle"} -->
      <p class="instructor-subtitle">Người Sáng Lập &amp; Giảng Viên Trực Tiếp</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":2,"className":"instructor-name"} -->
      <h2 class="wp-block-heading instructor-name">Master Lily Chen</h2>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"className":"instructor-bio"} -->
      <p class="instructor-bio">Chào bạn, mình là <strong>Lily Chen (Nguyễn Phương Ly)</strong>. Với hơn 6 năm gắn bó cùng nghề trang điểm tại TP. Thủ Dầu Một, Bình Dương, mình đã đồng hành và dẫn dắt hơn 200+ học viên — từ những bạn chưa từng biết cầm cây cọ đến khi tự tin làm chủ studio riêng hoặc làm đẹp cho chính bản thân mỗi ngày.</p>
      <!-- /wp:paragraph -->
      <!-- wp:quote {"className":"instructor-quote"} -->
      <blockquote class="wp-block-quote instructor-quote"><p>“Đối với Lily, makeup không phải là biến bạn thành một con người xa lạ, mà là kỹ thuật tôn vinh những đường nét đẹp nhất vốn có trên gương mặt bạn. Dạy nghề bằng sự chân thành, cầm tay uốn nắn từng nét cọ, không giấu nghề.”</p></blockquote>
      <!-- /wp:quote -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 5. Pattern: Lead Consultation Banner
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/lead-banner', array(
        'title'       => __('Banner Đăng Ký Tư Vấn', 'lilychen-academy'),
        'description' => __('Khối kêu gọi học viên liên hệ tư vấn lộ trình và hotline', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"section-padding conversion-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group section-padding conversion-section"><div class="container" style="text-align:center;max-width:800px;margin:0 auto;">
  <!-- wp:paragraph {"align":"center","className":"section-kicker"} -->
  <p class="has-text-align-center section-kicker">Tư Vấn 1-1 Miễn Phí</p>
  <!-- /wp:paragraph -->
  <!-- wp:heading {"textAlign":"center","level":2,"className":"section-title"} -->
  <h2 class="has-text-align-center wp-block-heading section-title">Bạn Đang Tìm Khóa Học Phù Hợp?</h2>
  <!-- /wp:heading -->
  <!-- wp:paragraph {"align":"center","className":"lead-banner-desc"} -->
  <p class="has-text-align-center lead-banner-desc">Liên hệ trực tiếp cùng Master Lily Chen để được phân tích nền da, định hướng phong cách và nhận lịch học linh hoạt nhất.</p>
  <!-- /wp:paragraph -->
  <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
  <div class="wp-block-buttons">
    <!-- wp:button {"className":"btn btn-primary btn-lg"} -->
    <div class="wp-block-button btn btn-primary btn-lg"><a class="wp-block-button__link wp-element-button" href="tel:0889979791">Gọi Hotline: 088 997 97 91</a></div>
    <!-- /wp:button -->
    <!-- wp:button {"className":"btn btn-secondary btn-lg"} -->
    <div class="wp-block-button btn btn-secondary btn-lg"><a class="wp-block-button__link wp-element-button" href="https://zalo.me/0889979791" target="_blank" rel="noopener noreferrer">Chat Zalo Tư Vấn</a></div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 6. Pattern: Mosaic Photo Showcase (5 ảnh thực tế)
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/gallery-mosaic', array(
        'title'       => __('Khối 5 Ảnh Mosaic Tác Phẩm', 'lilychen-academy'),
        'description' => __('Khối trưng bày 5 ảnh tác phẩm thực tế (người dùng có thể thay từng ảnh trực tiếp)', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"proto-transition","layout":{"type":"constrained"}} -->
<div class="wp-block-group proto-transition"><div class="container">
  <!-- wp:heading {"level":2,"className":"transition-title"} -->
  <h2 class="wp-block-heading transition-title">Vẻ Đẹp Độc Bản Qua Từng Nét Cọ (Tác phẩm thực tế 100%)</h2>
  <!-- /wp:heading -->
  <!-- wp:paragraph -->
  <p><a href="' . esc_url(home_url('/portfolio/')) . '" class="transition-link">Khám phá bộ sưu tập tác phẩm học viên &rarr;</a></p>
  <!-- /wp:paragraph -->
  <!-- wp:columns {"columns":5,"className":"photo-mosaic"} -->
  <div class="wp-block-columns photo-mosaic">
    <!-- wp:column {"className":"photo-card"} -->
    <div class="wp-block-column photo-card">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"photo-asset"} -->
      <figure class="wp-block-image size-large photo-asset"><img src="' . esc_url($img_dir . 'tacpham6.webp') . '" alt="Tác phẩm makeup cô dâu"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"className":"photo-card"} -->
    <div class="wp-block-column photo-card">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"photo-asset"} -->
      <figure class="wp-block-image size-large photo-asset"><img src="' . esc_url($img_dir . 'IMG_1644.webp') . '" alt="Layout makeup Douyin"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"className":"photo-card"} -->
    <div class="wp-block-column photo-card">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"photo-asset"} -->
      <figure class="wp-block-image size-large photo-asset"><img src="' . esc_url($img_dir . 'IMG_1680.webp') . '" alt="Layout cô dâu phong cách truyền thống"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"className":"photo-card"} -->
    <div class="wp-block-column photo-card">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"photo-asset"} -->
      <figure class="wp-block-image size-large photo-asset"><img src="' . esc_url($img_dir . 'tacpham7.webp') . '" alt="Tác phẩm dự tiệc thanh lịch"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"className":"photo-card"} -->
    <div class="wp-block-column photo-card">
      <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"photo-asset"} -->
      <figure class="wp-block-image size-large photo-asset"><img src="' . esc_url($img_dir . 'IMG_1646.webp') . '" alt="Layout makeup cá nhân"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 7. Pattern: Testimonials Grid (3 cảm nhận học viên)
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/testimonials-grid', array(
        'title'       => __('Cảm Nhận Học Viên (3 Đánh Giá & 5 Sao)', 'lilychen-academy'),
        'description' => __('Khối 3 thẻ cảm nhận học viên đã tốt nghiệp kèm điểm đánh giá 4.9 sao', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"section-padding testimonials-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group section-padding testimonials-section"><div class="container">
  <!-- wp:heading {"textAlign":"center","level":2,"className":"section-title"} -->
  <h2 class="has-text-align-center wp-block-heading section-title">Cảm Nhận Học Viên</h2>
  <!-- /wp:heading -->
  <!-- wp:paragraph {"align":"center","className":"testimonials-summary"} -->
  <p class="has-text-align-center testimonials-summary">★★★★★ <strong>4.9 / 5.0 ⭐</strong> Điểm đánh giá trung bình từ 200+ học viên trên Google &amp; Facebook</p>
  <!-- /wp:paragraph -->
  <!-- wp:columns {"columns":3,"className":"testimonials-grid"} -->
  <div class="wp-block-columns testimonials-grid">
    <!-- wp:column {"className":"testimonial-card"} -->
    <div class="wp-block-column testimonial-card">
      <!-- wp:paragraph {"className":"testimonial-stars"} -->
      <p class="testimonial-stars">★★★★★</p>
      <!-- /wp:paragraph -->
      <!-- wp:quote {"className":"testimonial-quote"} -->
      <blockquote class="wp-block-quote testimonial-quote"><p>“Giảng viên dạy rất có tâm, sau khi hoàn thành khóa học cá nhân mình tự tin hơn hẳn. Giờ chỉ cần 10 phút là mình có lớp nền trong veo tự nhiên suốt cả ngày!”</p></blockquote>
      <!-- /wp:quote -->
      <!-- wp:image {"width":60,"height":60,"sizeSlug":"thumbnail","className":"author-avatar"} -->
      <figure class="wp-block-image size-thumbnail is-resized author-avatar"><img src="' . esc_url($img_dir . 'IMG_1646.webp') . '" alt="Trần Thu Hà" width="60" height="60"/></figure>
      <!-- /wp:image -->
      <!-- wp:paragraph {"className":"author-name"} -->
      <p class="author-name"><strong>Trần Thu Hà</strong><br><span style="font-size:0.85em;color:#6b7280;">Khóa Makeup Cá Nhân · Tốt nghiệp Tháng 1/2026</span></p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"className":"testimonial-card"} -->
    <div class="wp-block-column testimonial-card">
      <!-- wp:paragraph {"className":"testimonial-stars"} -->
      <p class="testimonial-stars">★★★★★</p>
      <!-- /wp:paragraph -->
      <!-- wp:quote {"className":"testimonial-quote"} -->
      <blockquote class="wp-block-quote testimonial-quote"><p>“Đây là nơi xứng đáng nhất để học nghề tại Bình Dương, chỉ dạy cực kỳ nhiệt tình. Hoàn thành khóa chuyên nghiệp mình đã tự tin ra nghề nhận khách ngay.”</p></blockquote>
      <!-- /wp:quote -->
      <!-- wp:image {"width":60,"height":60,"sizeSlug":"thumbnail","className":"author-avatar"} -->
      <figure class="wp-block-image size-thumbnail is-resized author-avatar"><img src="' . esc_url($img_dir . 'IMG_1644.webp') . '" alt="Lê Mỹ Diệu" width="60" height="60"/></figure>
      <!-- /wp:image -->
      <!-- wp:paragraph {"className":"author-name"} -->
      <p class="author-name"><strong>Lê Mỹ Diệu</strong><br><span style="font-size:0.85em;color:#6b7280;">Khóa Makeup Chuyên Nghiệp · Hiện là Freelance MUA</span></p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"className":"testimonial-card"} -->
    <div class="wp-block-column testimonial-card">
      <!-- wp:paragraph {"className":"testimonial-stars"} -->
      <p class="testimonial-stars">★★★★★</p>
      <!-- /wp:paragraph -->
      <!-- wp:quote {"className":"testimonial-quote"} -->
      <blockquote class="wp-block-quote testimonial-quote"><p>“Cô luôn cầm tay chỉ dạy, kiên nhẫn sửa từng nét cọ, rất là biết ơn cô! Sau khi tốt nghiệp cô còn hướng dẫn mình cách chụp ảnh mẫu và set up ánh sáng.”</p></blockquote>
      <!-- /wp:quote -->
      <!-- wp:image {"width":60,"height":60,"sizeSlug":"thumbnail","className":"author-avatar"} -->
      <figure class="wp-block-image size-thumbnail is-resized author-avatar"><img src="' . esc_url($img_dir . 'IMG_1680.webp') . '" alt="Nguyễn Minh Trang" width="60" height="60"/></figure>
      <!-- /wp:image -->
      <!-- wp:paragraph {"className":"author-name"} -->
      <p class="author-name"><strong>Nguyễn Minh Trang</strong><br><span style="font-size:0.85em;color:#6b7280;">Khóa Makeup Chuyên Nghiệp · Đã mở Studio riêng</span></p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 8. Pattern: FAQ Accordion
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/faq-accordion', array(
        'title'       => __('Câu Hỏi Thường Gặp (FAQ)', 'lilychen-academy'),
        'description' => __('Khối accordion 6 câu hỏi và giải đáp chi tiết về học phí, dụng cụ và lịch học', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"section-padding faq-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group section-padding faq-section"><div class="container faq-container">
  <!-- wp:heading {"textAlign":"center","level":2,"className":"section-title"} -->
  <h2 class="has-text-align-center wp-block-heading section-title">Câu Hỏi Thường Gặp</h2>
  <!-- /wp:heading -->
  <!-- wp:group {"className":"faq-item"} -->
  <div class="wp-block-group faq-item">
    <!-- wp:heading {"level":4,"className":"faq-question-title"} -->
    <h4 class="wp-block-heading faq-question-title">1. Tôi chưa từng biết trang điểm hoặc vụng về kẻ mắt thì có học được không?</h4>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"className":"faq-answer-text"} -->
    <p class="faq-answer-text"><strong>Hoàn toàn học được và làm đẹp được!</strong> Tại Lily Chen Academy, giáo trình được xây dựng theo phương pháp Cầm tay chỉ việc 1 kèm 1, uốn nắn từng động tác cổ tay và lực miết cọ cho đến khi bạn tự tin.</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
  <!-- wp:group {"className":"faq-item"} -->
  <div class="wp-block-group faq-item">
    <!-- wp:heading {"level":4,"className":"faq-question-title"} -->
    <h4 class="wp-block-heading faq-question-title">2. Học phí có phát sinh thêm tiền mỹ phẩm hay dụng cụ trong quá trình học không?</h4>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"className":"faq-answer-text"} -->
    <p class="faq-answer-text"><strong>Tuyệt đối không phát sinh chi phí ẩn!</strong> Học viện tài trợ 100% mỹ phẩm chính hãng và đồ nghề trong suốt thời gian học.</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
  <!-- wp:group {"className":"faq-item"} -->
  <div class="wp-block-group faq-item">
    <!-- wp:heading {"level":4,"className":"faq-question-title"} -->
    <h4 class="wp-block-heading faq-question-title">3. Khóa Chuyên Nghiệp có chính sách hỗ trợ chia nhỏ học phí trả góp không?</h4>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"className":"faq-answer-text"} -->
    <p class="faq-answer-text"><strong>Có! Hỗ trợ chia 2 đến 3 đợt thanh toán</strong> linh hoạt 0% lãi suất trong 3 tháng đào tạo.</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
  <!-- wp:group {"className":"faq-item"} -->
  <div class="wp-block-group faq-item">
    <!-- wp:heading {"level":4,"className":"faq-question-title"} -->
    <h4 class="wp-block-heading faq-question-title">4. Tốt nghiệp khóa Chuyên Nghiệp xong có cơ hội việc làm và thu nhập ra sao?</h4>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"className":"faq-answer-text"} -->
    <p class="faq-answer-text">Được giữ lại làm trợ giảng hoặc giới thiệu việc làm tại các Bridal Studio uy tín, thu nhập từ 15–35 triệu/tháng.</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
  <!-- wp:group {"className":"faq-item"} -->
  <div class="wp-block-group faq-item">
    <!-- wp:heading {"level":4,"className":"faq-question-title"} -->
    <h4 class="wp-block-heading faq-question-title">5. Trước khi nhập học tôi có cần tự mua mỹ phẩm hay cọ trang điểm không?</h4>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"className":"faq-answer-text"} -->
    <p class="faq-answer-text">Bạn không cần mua trước. Học viên đăng ký sớm được tặng ngay bộ cọ trang điểm chuyên nghiệp trị giá 850.000đ.</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
  <!-- wp:group {"className":"faq-item"} -->
  <div class="wp-block-group faq-item">
    <!-- wp:heading {"level":4,"className":"faq-question-title"} -->
    <h4 class="wp-block-heading faq-question-title">6. Thời gian học có linh hoạt cho người đang đi làm văn phòng hoặc sinh viên không?</h4>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"className":"faq-answer-text"} -->
    <p class="faq-answer-text">Cực kỳ linh hoạt với 3 ca: Sáng (09:00 - 11:30), Chiều (14:00 - 16:30) và Tối (18:00 - 20:30) từ Thứ 2 đến Thứ 7.</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->
</div></div>
<!-- /wp:group -->',
    ));

    // -------------------------------------------------------------------------
    // 9. Pattern: Contact & Local SEO Card
    // -------------------------------------------------------------------------
    register_block_pattern('lilychen/contact-nap-box', array(
        'title'       => __('Thông Tin Liên Hệ & Bản Đồ Google Maps', 'lilychen-academy'),
        'description' => __('Khối thông tin liên hệ chuẩn Local SEO kèm hotline, địa chỉ KDC Hiệp Phát 2 và nút đăng ký', 'lilychen-academy'),
        'categories'  => array('lilychen-patterns'),
        'content'     => '<!-- wp:group {"className":"section-padding","layout":{"type":"constrained"}} -->
<div class="wp-block-group section-padding"><div class="container" style="max-width:900px;margin:0 auto;background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
  <!-- wp:heading {"level":2,"className":"section-title"} -->
  <h2 class="wp-block-heading section-title">Thông Tin Liên Hệ Lily Chen Academy</h2>
  <!-- /wp:heading -->
  <!-- wp:columns -->
  <div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:paragraph -->
      <p>📍 <strong>Địa chỉ:</strong> B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành, TP. Thủ Dầu Một, Bình Dương</p>
      <!-- /wp:paragraph -->
      <!-- wp:paragraph -->
      <p>📞 <strong>Hotline / Zalo:</strong> <a href="tel:0889979791" style="color:#d4537a;font-weight:700;">088 997 97 91</a></p>
      <!-- /wp:paragraph -->
      <!-- wp:paragraph -->
      <p>⏰ <strong>Giờ làm việc:</strong> 08:30 - 20:30 (Thứ 2 - CN)</p>
      <!-- /wp:paragraph -->
      <!-- wp:paragraph -->
      <p>✉️ <strong>Email:</strong> <a href="mailto:lilychenmakeup@gmail.com">lilychenmakeup@gmail.com</a></p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:buttons -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"btn btn-primary btn-lg"} -->
        <div class="wp-block-button btn btn-primary btn-lg"><a class="wp-block-button__link wp-element-button" href="' . esc_url(home_url('/#dang-ky')) . '">Đăng Ký Tư Vấn</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ));
}
add_action('init', 'lilychen_register_block_patterns');
