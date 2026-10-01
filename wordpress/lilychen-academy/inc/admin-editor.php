<?php
/**
 * Editor-Accessible Content Management System for Lily Chen Academy Theme
 * Allows users with 'edit_pages' capability (Editor role) to edit homepage content
 * and select images from WordPress Media Library without requiring Administrator rights.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Admin Menu for Editors
 */
function lilychen_register_editor_admin_menu() {
    add_menu_page(
        __('Nội Dung Trang Chủ', 'lilychen-academy'),
        __('Nội Dung Trang Chủ', 'lilychen-academy'),
        'edit_pages', // Accessible by Editor role!
        'lilychen-home-content',
        'lilychen_render_home_content_page',
        'dashicons-edit-page',
        20
    );
}
add_action('admin_menu', 'lilychen_register_editor_admin_menu');

/**
 * Enqueue Media Library Uploader Scripts on the Editor Content Page
 */
function lilychen_editor_admin_scripts($hook) {
    if ($hook !== 'toplevel_page_lilychen-home-content') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style('thickbox');
    wp_enqueue_script('thickbox');
}
add_action('admin_enqueue_scripts', 'lilychen_editor_admin_scripts');

// Note: lilychen_get_content() is defined in inc/template-tags.php as the unified helper

/**
 * Render the Content Management Page for Editors
 */
function lilychen_render_home_content_page() {
    if (!current_user_can('edit_pages')) {
        wp_die(__('Bạn không có đủ quyền để truy cập trang này.', 'lilychen-academy'));
    }

    $saved_message = false;

    // Handle Form Submission (using wp_unslash to prevent slash escaping on quotes)
    if (isset($_POST['lilychen_save_content']) && check_admin_referer('lilychen_editor_content_action', 'lilychen_editor_content_nonce')) {
        $raw_data = isset($_POST['lilychen_content']) ? (array) wp_unslash($_POST['lilychen_content']) : array();
        $sanitized_data = array();

        foreach ($raw_data as $k => $v) {
            if (is_array($v)) {
                $sanitized_data[$k] = array_map('sanitize_text_field', $v);
            } elseif (strpos($k, '_url') !== false || strpos($k, '_image') !== false || strpos($k, '_avatar') !== false || strpos($k, '_img') !== false || strpos($k, '_art_') !== false) {
                $sanitized_data[$k] = esc_url_raw(trim($v));
            } elseif (strpos($k, '_bio') !== false || strpos($k, '_quote') !== false || strpos($k, '_summary') !== false || strpos($k, '_ans') !== false || strpos($k, '_a_') !== false || strpos($k, '_desc') !== false) {
                $sanitized_data[$k] = wp_kses_post(trim($v));
            } else {
                $sanitized_data[$k] = sanitize_text_field(trim($v));
            }
        }

        update_option('lilychen_structured_home_content', $sanitized_data);
        $saved_message = true;
    }

    $courses      = lilychen_default_courses();
    $gallery      = lilychen_default_gallery_items();
    $testimonials = lilychen_default_testimonials();
    $faqs         = lilychen_default_faqs();
    ?>
    <div class="wrap" style="max-width: 1100px;">
      <h1 style="font-size: 1.8rem; margin-bottom: 8px; display: flex; align-items: center; gap: 10px;">
        <span class="dashicons dashicons-admin-customizer" style="font-size: 1.8rem; width: 1.8rem; height: 1.8rem; color: #d4537a;"></span>
        <?php esc_html_e('Quản Trị Nội Dung & Hình Ảnh Trang Chủ', 'lilychen-academy'); ?>
      </h1>
      <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 20px;">
        <?php esc_html_e('Khu vực dành riêng cho Ban Biên Tập (Editor). Mọi chỉnh sửa được lưu trực tiếp vào cơ sở dữ liệu và tồn tại an toàn qua các lần cập nhật theme. Không cần quyền Administrator và không cần sửa PHP/HTML.', 'lilychen-academy'); ?>
      </p>

      <?php if ($saved_message) : ?>
        <div class="notice notice-success is-dismissible" style="border-left-color: #2e7d4f;">
          <p><strong><?php esc_html_e('✓ Đã lưu thay đổi nội dung trang chủ thành công!', 'lilychen-academy'); ?></strong></p>
        </div>
      <?php endif; ?>

      <form method="post" action="" id="lilychenContentForm">
        <?php wp_nonce_field('lilychen_editor_content_action', 'lilychen_editor_content_nonce'); ?>

        <style>
          .lily-admin-section { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 24px; padding: 20px 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); }
          .lily-admin-title { font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-top: 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; display: flex; align-items: center; gap: 8px; }
          .lily-field-row { margin-bottom: 16px; }
          .lily-label { display: block; font-weight: 600; color: #334155; margin-bottom: 5px; font-size: 0.92rem; }
          .lily-input { width: 100%; max-width: 650px; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; }
          .lily-textarea { width: 100%; max-width: 750px; min-height: 80px; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; }
          .lily-img-preview-wrap { display: flex; align-items: center; gap: 14px; margin-top: 8px; }
          .lily-img-thumb { width: 90px; height: 90px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; background: #f8fafc; }
          .lily-btn-upload { background: #f1f5f9; border: 1px solid #cbd5e1; padding: 6px 14px; border-radius: 6px; cursor: pointer; font-size: 0.88rem; font-weight: 600; }
          .lily-btn-upload:hover { background: #e2e8f0; }
          .lily-btn-remove { background: #fee2e2; border: 1px solid #fca5a5; color: #b91c1c; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.88rem; }
          .lily-card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 18px; }
          .lily-sub-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 14px; }
        </style>

        <!-- 1. HERO SECTION -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">1. <?php esc_html_e('Phần Đầu Trang (Hero Section)', 'lilychen-academy'); ?></h2>
          
          <div class="lily-field-row">
            <label class="lily-label"><?php esc_html_e('Vị trí hiển thị (Location Kicker)', 'lilychen-academy'); ?></label>
            <input type="text" name="lilychen_content[hero_location]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_location', 'Thủ Dầu Một · Bình Dương')); ?>">
          </div>

          <div class="lily-field-row">
            <label class="lily-label"><?php esc_html_e('Tiêu đề dòng 1', 'lilychen-academy'); ?></label>
            <input type="text" name="lilychen_content[hero_title_1]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_title_1', 'Đào tạo Makeup Chuyên nghiệp')); ?>">
          </div>

          <div class="lily-field-row">
            <label class="lily-label"><?php esc_html_e('Tiêu đề dòng 2 (Màu nhấn Rose)', 'lilychen-academy'); ?></label>
            <input type="text" name="lilychen_content[hero_title_2]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_title_2', '& Cá nhân')); ?>">
          </div>

          <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div class="lily-field-row" style="flex: 1; min-width: 250px;">
              <label class="lily-label"><?php esc_html_e('Nút CTA 1: Chữ', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hero_cta1_text]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_cta1_text', 'Xem khóa học')); ?>">
              <label class="lily-label" style="margin-top: 6px;"><?php esc_html_e('Nút CTA 1: Đường dẫn (URL/Anchor)', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hero_cta1_url]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_cta1_url', '#khoa-hoc')); ?>">
            </div>
            <div class="lily-field-row" style="flex: 1; min-width: 250px;">
              <label class="lily-label"><?php esc_html_e('Nút CTA 2: Chữ', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hero_cta2_text]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_cta2_text', 'Xem tác phẩm')); ?>">
              <label class="lily-label" style="margin-top: 6px;"><?php esc_html_e('Nút CTA 2: Đường dẫn (URL/Anchor)', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hero_cta2_url]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hero_cta2_url', home_url('/portfolio/'))); ?>">
            </div>
          </div>
        </div>

        <!-- 2. MOSAIC PHOTOS (5 ẢNH CHỌN TỪ THƯ VIỆN) -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">2. <?php esc_html_e('Khối 5 Ảnh Mosaic Tác Phẩm Thực Tế', 'lilychen-academy'); ?></h2>
          <p style="color: #64748b; font-size: 0.88rem;"><?php esc_html_e('Chọn hoặc thay thế 5 hình ảnh thực tế từ Thư viện Media. Giữ nguyên tỷ lệ ảnh dọc sắc nét.', 'lilychen-academy'); ?></p>
          
          <div class="lily-card-grid">
            <?php
            $default_mosaic = array(
                'mosaic_img_1' => array('file' => 'tacpham6.webp', 'label' => 'Ảnh Mosaic 1 (Cô dâu cam đào)'),
                'mosaic_img_2' => array('file' => 'IMG_1644.webp', 'label' => 'Ảnh Mosaic 2 (Douyin bọng mắt)'),
                'mosaic_img_3' => array('file' => 'IMG_1680.webp', 'label' => 'Ảnh Mosaic 3 (Cô dâu truyền thống)'),
                'mosaic_img_4' => array('file' => 'tacpham7.webp', 'label' => 'Ảnh Mosaic 4 (Dự tiệc thanh lịch)'),
                'mosaic_img_5' => array('file' => 'IMG_1646.webp', 'label' => 'Ảnh Mosaic 5 (Makeup cá nhân 10p)'),
            );
            foreach ($default_mosaic as $mkey => $minfo) :
                $curr_val = lilychen_get_content($mkey, lilychen_image_url($minfo['file']));
                ?>
                <div class="lily-sub-card">
                  <span class="lily-label"><?php echo esc_html($minfo['label']); ?></span>
                  <div class="lily-img-preview-wrap">
                    <img src="<?php echo esc_url($curr_val); ?>" class="lily-img-thumb" id="preview_<?php echo esc_attr($mkey); ?>">
                    <div>
                      <input type="hidden" name="lilychen_content[<?php echo esc_attr($mkey); ?>]" id="input_<?php echo esc_attr($mkey); ?>" value="<?php echo esc_attr($curr_val); ?>">
                      <button type="button" class="lily-btn-upload select-media-btn" data-target="<?php echo esc_attr($mkey); ?>">
                        <?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?>
                      </button>
                      <button type="button" class="lily-btn-remove reset-media-btn" data-target="<?php echo esc_attr($mkey); ?>" data-default="<?php echo esc_url(lilychen_image_url($minfo['file'])); ?>">
                        <?php esc_html_e('Mặc định', 'lilychen-academy'); ?>
                      </button>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 3. KHÓA HỌC TUYỂN SINH -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">3. <?php esc_html_e('Khóa Học Tuyển Sinh (Chuyên Nghiệp & Cá Nhân)', 'lilychen-academy'); ?></h2>
          
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Khóa Pro -->
            <div class="lily-sub-card">
              <h3 style="margin-top: 0; color: #b93b62;">★ <?php esc_html_e('Khóa Makeup Chuyên Nghiệp', 'lilychen-academy'); ?></h3>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Mức học phí', 'lilychen-academy'); ?></label>
                <input type="text" name="lilychen_content[course_pro_price]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('course_pro_price', '25.000.000đ')); ?>">
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Ghi chú ưu đãi & trả góp', 'lilychen-academy'); ?></label>
                <input type="text" name="lilychen_content[course_pro_price_sub]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('course_pro_price_sub', 'Hỗ trợ trả góp linh hoạt 2–3 đợt · Tặng bộ cọ chuyên nghiệp cao cấp')); ?>">
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Tóm tắt khóa học', 'lilychen-academy'); ?></label>
                <textarea name="lilychen_content[course_pro_summary]" class="lily-textarea" rows="3"><?php echo esc_textarea(lilychen_get_content('course_pro_summary', 'Đào tạo nghề toàn diện cho người muốn trở thành Makeup Artist tự do, làm việc tại bridal studio hoặc tự mở tiệm trang điểm. 90% thực hành mẫu thật dưới sự kèm cặp 1-1 trực tiếp của Master Lily Chen.')); ?></textarea>
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Ảnh đại diện khóa học', 'lilychen-academy'); ?></label>
                <?php $pro_img = lilychen_get_content('course_pro_image', lilychen_image_url('lilychen-king-queen-collage-2025.webp')); ?>
                <div class="lily-img-preview-wrap">
                  <img src="<?php echo esc_url($pro_img); ?>" class="lily-img-thumb" id="preview_course_pro_image">
                  <div>
                    <input type="hidden" name="lilychen_content[course_pro_image]" id="input_course_pro_image" value="<?php echo esc_attr($pro_img); ?>">
                    <button type="button" class="lily-btn-upload select-media-btn" data-target="course_pro_image"><?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?></button>
                    <button type="button" class="lily-btn-remove reset-media-btn" data-target="course_pro_image" data-default="<?php echo esc_url(lilychen_image_url('lilychen-king-queen-collage-2025.webp')); ?>"><?php esc_html_e('Mặc định', 'lilychen-academy'); ?></button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Khóa Cá Nhân -->
            <div class="lily-sub-card">
              <h3 style="margin-top: 0; color: #2563eb;">♥ <?php esc_html_e('Khóa Trang Điểm Cá Nhân', 'lilychen-academy'); ?></h3>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Mức học phí', 'lilychen-academy'); ?></label>
                <input type="text" name="lilychen_content[course_personal_price]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('course_personal_price', 'Từ 1.500.000đ')); ?>">
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Ghi chú mỹ phẩm & dụng cụ', 'lilychen-academy'); ?></label>
                <input type="text" name="lilychen_content[course_personal_price_sub]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('course_personal_price_sub', 'Mỹ phẩm & dụng cụ thực hành được chuẩn bị sẵn 100% tại lớp')); ?>">
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Tóm tắt khóa học', 'lilychen-academy'); ?></label>
                <textarea name="lilychen_content[course_personal_summary]" class="lily-textarea" rows="3"><?php echo esc_textarea(lilychen_get_content('course_personal_summary', 'Tự tin trang điểm nhẹ nhàng, tôn nét tự nhiên chỉ sau 10–15 phút mỗi sáng và làm chủ layout dự tiệc thanh lịch, không phụ thuộc tiệm. Giáo trình cá nhân hóa theo từng dáng mặt.')); ?></textarea>
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Ảnh đại diện khóa học', 'lilychen-academy'); ?></label>
                <?php $per_img = lilychen_get_content('course_personal_image', lilychen_image_url('IMG_1646.webp')); ?>
                <div class="lily-img-preview-wrap">
                  <img src="<?php echo esc_url($per_img); ?>" class="lily-img-thumb" id="preview_course_personal_image">
                  <div>
                    <input type="hidden" name="lilychen_content[course_personal_image]" id="input_course_personal_image" value="<?php echo esc_attr($per_img); ?>">
                    <button type="button" class="lily-btn-upload select-media-btn" data-target="course_personal_image"><?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?></button>
                    <button type="button" class="lily-btn-remove reset-media-btn" data-target="course_personal_image" data-default="<?php echo esc_url(lilychen_image_url('IMG_1646.webp')); ?>"><?php esc_html_e('Mặc định', 'lilychen-academy'); ?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 4. GALLERY ARTWORK (6 ẢNH HỌC VIÊN TỪ MEDIA LIBRARY) -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">4. <?php esc_html_e('Thư Viện Tác Phẩm Học Viên (6 Tác Phẩm)', 'lilychen-academy'); ?></h2>
          <p style="color: #64748b; font-size: 0.88rem;"><?php esc_html_e('Chọn ảnh từ Thư viện Media cho từng tác phẩm của học viên.', 'lilychen-academy'); ?></p>
          
          <div class="lily-card-grid">
            <?php
            $default_artworks = array(
                1 => array('file' => 'tacpham6.webp', 'cat' => 'codau', 'desc' => 'Tác phẩm 1: Cô dâu trong trẻo'),
                2 => array('file' => 'tacpham7.webp', 'cat' => 'tiec', 'desc' => 'Tác phẩm 2: Dự tiệc sang trọng'),
                3 => array('file' => 'IMG_1644.webp', 'cat' => 'douyin', 'desc' => 'Tác phẩm 3: Douyin thanh thuần'),
                4 => array('file' => 'IMG_1646.webp', 'cat' => 'douyin', 'desc' => 'Tác phẩm 4: Che khuyết điểm & Eyeliner'),
                5 => array('file' => 'IMG_1680.webp', 'cat' => 'codau', 'desc' => 'Tác phẩm 5: Tốt nghiệp chuyên nghiệp'),
                6 => array('file' => 'IMG_1697.webp', 'cat' => 'tiec', 'desc' => 'Tác phẩm 6: Kỷ yếu thanh xuân'),
            );
            foreach ($default_artworks as $anum => $ainfo) :
                $akey = 'gallery_art_' . $anum;
                $curr_art = lilychen_get_content($akey, lilychen_image_url($ainfo['file']));
                ?>
                <div class="lily-sub-card">
                  <span class="lily-label"><?php echo esc_html($ainfo['desc']); ?></span>
                  <div class="lily-img-preview-wrap">
                    <img src="<?php echo esc_url($curr_art); ?>" class="lily-img-thumb" id="preview_<?php echo esc_attr($akey); ?>">
                    <div>
                      <input type="hidden" name="lilychen_content[<?php echo esc_attr($akey); ?>]" id="input_<?php echo esc_attr($akey); ?>" value="<?php echo esc_attr($curr_art); ?>">
                      <button type="button" class="lily-btn-upload select-media-btn" data-target="<?php echo esc_attr($akey); ?>"><?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?></button>
                      <button type="button" class="lily-btn-remove reset-media-btn" data-target="<?php echo esc_attr($akey); ?>" data-default="<?php echo esc_url(lilychen_image_url($ainfo['file'])); ?>"><?php esc_html_e('Mặc định', 'lilychen-academy'); ?></button>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 5. GIẢNG VIÊN MASTER LILY CHEN -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">5. <?php esc_html_e('Giảng Viên Master Lily Chen (Khối E-E-A-T)', 'lilychen-academy'); ?></h2>
          
          <div style="display: flex; gap: 24px; flex-wrap: wrap;">
            <div style="width: 160px;">
              <label class="lily-label"><?php esc_html_e('Ảnh Giảng Viên', 'lilychen-academy'); ?></label>
              <?php $ins_img = lilychen_get_content('instructor_image', lilychen_image_url('IMG_1683.webp')); ?>
              <img src="<?php echo esc_url($ins_img); ?>" class="lily-img-thumb" id="preview_instructor_image" style="width: 140px; height: 160px;">
              <div style="margin-top: 8px;">
                <input type="hidden" name="lilychen_content[instructor_image]" id="input_instructor_image" value="<?php echo esc_attr($ins_img); ?>">
                <button type="button" class="lily-btn-upload select-media-btn" data-target="instructor_image" style="width: 140px; margin-bottom: 4px;"><?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?></button>
                <button type="button" class="lily-btn-remove reset-media-btn" data-target="instructor_image" data-default="<?php echo esc_url(lilychen_image_url('IMG_1683.webp')); ?>" style="width: 140px;"><?php esc_html_e('Mặc định', 'lilychen-academy'); ?></button>
              </div>
            </div>

            <div style="flex: 1; min-width: 300px;">
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Tên Giảng Viên', 'lilychen-academy'); ?></label>
                <input type="text" name="lilychen_content[instructor_name]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('instructor_name', 'Master Lily Chen')); ?>">
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Số năm kinh nghiệm', 'lilychen-academy'); ?></label>
                <input type="text" name="lilychen_content[instructor_exp]" class="lily-input" style="max-width: 120px;" value="<?php echo esc_attr(lilychen_get_content('instructor_exp', '6+')); ?>">
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Tiểu sử tóm tắt', 'lilychen-academy'); ?></label>
                <textarea name="lilychen_content[instructor_bio]" class="lily-textarea" rows="3"><?php echo esc_textarea(lilychen_get_content('instructor_bio', 'Chào bạn, mình là Lily Chen (Nguyễn Phương Ly). Với hơn 6 năm gắn bó cùng nghề trang điểm tại TP. Thủ Dầu Một, Bình Dương, mình đã đồng hành và dẫn dắt hơn 200+ học viên — từ những bạn chưa từng biết cầm cây cọ đến khi tự tin làm chủ studio riêng hoặc làm đẹp cho chính bản thân mỗi ngày.')); ?></textarea>
              </div>
              <div class="lily-field-row">
                <label class="lily-label"><?php esc_html_e('Triết lý đào tạo (Quote)', 'lilychen-academy'); ?></label>
                <textarea name="lilychen_content[instructor_quote]" class="lily-textarea" rows="2"><?php echo esc_textarea(lilychen_get_content('instructor_quote', 'Đối với Lily, makeup không phải là biến bạn thành một con người xa lạ, mà là kỹ thuật tôn vinh những đường nét đẹp nhất vốn có trên gương mặt bạn. Dạy nghề bằng sự chân thành, cầm tay uốn nắn từng nét cọ, không giấu nghề.')); ?></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- 6. CẢM NHẬN HỌC VIÊN (3 TESTIMONIALS & ẢNH ĐẠI DIỆN) -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">6. <?php esc_html_e('Cảm Nhận Học Viên Đã Tốt Nghiệp (3 Đánh Giá)', 'lilychen-academy'); ?></h2>
          <div class="lily-card-grid">
            <?php foreach ($testimonials as $tidx => $t) : 
              $tnum = $tidx + 1;
              $curr_avatar = lilychen_get_content('testimonial_avatar_' . $tnum, lilychen_image_url($t['avatar']));
            ?>
              <div class="lily-sub-card">
                <h4 style="margin-top: 0; color: #1e293b;"><?php printf(esc_html__('Đánh giá %d', 'lilychen-academy'), $tnum); ?></h4>
                <div class="lily-field-row">
                  <label class="lily-label"><?php esc_html_e('Ảnh đại diện học viên', 'lilychen-academy'); ?></label>
                  <div class="lily-img-preview-wrap">
                    <img src="<?php echo esc_url($curr_avatar); ?>" class="lily-img-thumb" id="preview_testimonial_avatar_<?php echo esc_attr($tnum); ?>" style="width: 70px; height: 70px; border-radius: 50%;">
                    <div>
                      <input type="hidden" name="lilychen_content[testimonial_avatar_<?php echo esc_attr($tnum); ?>]" id="input_testimonial_avatar_<?php echo esc_attr($tnum); ?>" value="<?php echo esc_attr($curr_avatar); ?>">
                      <button type="button" class="lily-btn-upload select-media-btn" data-target="testimonial_avatar_<?php echo esc_attr($tnum); ?>"><?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?></button>
                      <button type="button" class="lily-btn-remove reset-media-btn" data-target="testimonial_avatar_<?php echo esc_attr($tnum); ?>" data-default="<?php echo esc_url(lilychen_image_url($t['avatar'])); ?>"><?php esc_html_e('Mặc định', 'lilychen-academy'); ?></button>
                    </div>
                  </div>
                </div>
                <div class="lily-field-row">
                  <label class="lily-label"><?php esc_html_e('Tên học viên', 'lilychen-academy'); ?></label>
                  <input type="text" name="lilychen_content[testimonial_name_<?php echo $tnum; ?>]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('testimonial_name_' . $tnum, $t['name'])); ?>">
                </div>
                <div class="lily-field-row">
                  <label class="lily-label"><?php esc_html_e('Khóa học & Tốt nghiệp', 'lilychen-academy'); ?></label>
                  <input type="text" name="lilychen_content[testimonial_grad_<?php echo $tnum; ?>]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('testimonial_grad_' . $tnum, $t['course'] . ' · ' . $t['grad'])); ?>">
                </div>
                <div class="lily-field-row">
                  <label class="lily-label"><?php esc_html_e('Nội dung nhận xét', 'lilychen-academy'); ?></label>
                  <textarea name="lilychen_content[testimonial_quote_<?php echo $tnum; ?>]" class="lily-textarea" rows="4"><?php echo esc_textarea(lilychen_get_content('testimonial_quote_' . $tnum, $t['quote'])); ?></textarea>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 7. HOẠT ĐỘNG THỰC TẾ (KING & QUEEN TDMU 2025) -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">7. <?php esc_html_e('Hoạt Động Thực Tế (Show King & Queen 2025)', 'lilychen-academy'); ?></h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Tiền tố hoạt động', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[activity_prefix]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('activity_prefix', 'Hoạt Động Thực Tế: Chung Kết')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Tên sự kiện / Nổi bật (Chữ Gradient Rose)', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[activity_highlight]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('activity_highlight', 'King & Queen 2025')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Đơn vị / Hậu tố', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[activity_sub]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('activity_sub', '(Đại Học Thủ Dầu Một)')); ?>">
            </div>
          </div>
          <div class="lily-field-row">
            <label class="lily-label"><?php esc_html_e('Mô tả hoạt động', 'lilychen-academy'); ?></label>
            <textarea name="lilychen_content[activity_desc]" class="lily-textarea" style="max-width: 100%;" rows="2"><?php echo esc_textarea(lilychen_get_content('activity_desc', 'Master Lily Chen giữ vai trò Ban Giám Khảo Chuyên Môn cùng đội ngũ học viên tài trợ toàn bộ layout trang điểm cho thí sinh trong đêm chung kết.')); ?></textarea>
          </div>
          <div class="lily-card-grid">
            <?php
            $default_acts = array(
              1 => array('file' => 'lilychen-team-tdmu-2025.webp', 'label' => 'Ảnh hoạt động 1 (Đội ngũ học viện)'),
              2 => array('file' => 'lilychen-tdmu-award-ceremony.webp', 'label' => 'Ảnh hoạt động 2 (Trao giải trên sân khấu)'),
              3 => array('file' => 'lilychen-king-queen-collage-2025.webp', 'label' => 'Ảnh hoạt động 3 (Layout thí sinh)'),
            );
            foreach ($default_acts as $act_num => $act_info) :
              $act_key = 'activity_img_' . $act_num;
              $act_val = lilychen_get_content($act_key, lilychen_image_url($act_info['file']));
            ?>
              <div class="lily-sub-card">
                <span class="lily-label"><?php echo esc_html($act_info['label']); ?></span>
                <div class="lily-img-preview-wrap">
                  <img src="<?php echo esc_url($act_val); ?>" class="lily-img-thumb" id="preview_<?php echo esc_attr($act_key); ?>">
                  <div>
                    <input type="hidden" name="lilychen_content[<?php echo esc_attr($act_key); ?>]" id="input_<?php echo esc_attr($act_key); ?>" value="<?php echo esc_attr($act_val); ?>">
                    <button type="button" class="lily-btn-upload select-media-btn" data-target="<?php echo esc_attr($act_key); ?>"><?php esc_html_e('Chọn ảnh Media', 'lilychen-academy'); ?></button>
                    <button type="button" class="lily-btn-remove reset-media-btn" data-target="<?php echo esc_attr($act_key); ?>" data-default="<?php echo esc_url(lilychen_image_url($act_info['file'])); ?>"><?php esc_html_e('Mặc định', 'lilychen-academy'); ?></button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 8. CÂU HỎI THƯỜNG GẶP (FAQ ACCORDION) -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">8. <?php esc_html_e('Câu Hỏi Thường GẶP (FAQ Accordion - 6 Câu)', 'lilychen-academy'); ?></h2>
          <p style="color: #64748b; font-size: 0.88rem;"><?php esc_html_e('Chỉnh sửa câu hỏi và nội dung giải đáp hiển thị trên accordion trang chủ.', 'lilychen-academy'); ?></p>
          <div style="display: flex; flex-direction: column; gap: 16px;">
            <?php foreach ($faqs as $fidx => $f) : $fnum = $fidx + 1; ?>
              <div class="lily-sub-card">
                <h4 style="margin: 0 0 10px; color: #1e293b;"><?php printf(esc_html__('Câu hỏi số %d', 'lilychen-academy'), $fnum); ?></h4>
                <div class="lily-field-row">
                  <label class="lily-label"><?php esc_html_e('Tiêu đề câu hỏi', 'lilychen-academy'); ?></label>
                  <input type="text" name="lilychen_content[faq_q_<?php echo $fnum; ?>]" class="lily-input" style="max-width: 100%;" value="<?php echo esc_attr(lilychen_get_content('faq_q_' . $fnum, $f['q'])); ?>">
                </div>
                <div class="lily-field-row" style="margin-bottom: 0;">
                  <label class="lily-label"><?php esc_html_e('Nội dung câu trả lời (Hỗ trợ định dạng HTML cơ bản)', 'lilychen-academy'); ?></label>
                  <textarea name="lilychen_content[faq_a_<?php echo $fnum; ?>]" class="lily-textarea" style="max-width: 100%;" rows="3"><?php echo esc_textarea(lilychen_get_content('faq_a_' . $fnum, $f['a'])); ?></textarea>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 9. THÔNG TIN LIÊN HỆ & FOOTER -->
        <div class="lily-admin-section">
          <h2 class="lily-admin-title">9. <?php esc_html_e('Thông Tin Liên Hệ & Chân Trang', 'lilychen-academy'); ?></h2>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Hotline hiển thị', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hotline_display]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hotline_display', '088 997 97 91')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Hotline bấm gọi (tel:)', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hotline_tel]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hotline_tel', '0889979791')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Link Chat Zalo', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[zalo_url]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('zalo_url', 'https://zalo.me/0889979791')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Email liên hệ', 'lilychen-academy'); ?></label>
              <input type="email" name="lilychen_content[email]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('email', 'lilychenmakeup@gmail.com')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Giờ làm việc', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[hours]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('hours', '08:30 - 20:30 (Thứ 2 - CN)')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Link Fanpage Facebook', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[fb_url]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('fb_url', 'https://www.facebook.com/LilyChenMakeup')); ?>">
            </div>
            <div class="lily-field-row">
              <label class="lily-label"><?php esc_html_e('Link Kênh TikTok', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[tiktok_url]" class="lily-input" value="<?php echo esc_attr(lilychen_get_content('tiktok_url', 'https://tiktok.com/@lilychenmakeup')); ?>">
            </div>
            <div class="lily-field-row" style="grid-column: 1 / -1;">
              <label class="lily-label"><?php esc_html_e('Địa chỉ cơ sở đào tạo', 'lilychen-academy'); ?></label>
              <input type="text" name="lilychen_content[address]" class="lily-input" style="max-width: 100%;" value="<?php echo esc_attr(lilychen_get_content('address', 'B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành, TP. Thủ Dầu Một, Bình Dương')); ?>">
            </div>
          </div>
        </div>

        <div style="position: sticky; bottom: 20px; background: #fff; padding: 14px 24px; border: 1px solid #cbd5e1; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between;">
          <span style="font-weight: 600; color: #475569;">
            <?php esc_html_e('Lưu ý: Mọi chỉnh sửa sẽ hiển thị ngay trên trang chủ sau khi lưu.', 'lilychen-academy'); ?>
          </span>
          <button type="submit" name="lilychen_save_content" class="button button-primary button-large" style="background: #d4537a; border-color: #b93b62; padding: 4px 24px; font-size: 1rem; height: auto;">
            <?php esc_html_e('LƯU NỘI DUNG TRANG CHỦ', 'lilychen-academy'); ?>
          </button>
        </div>
      </form>
    </div>

    <!-- Media Uploader Script -->
    <script>
      jQuery(document).ready(function($) {
        var mediaUploader;
        $('.select-media-btn').on('click', function(e) {
          e.preventDefault();
          var targetId = $(this).data('target');

          mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Chọn ảnh từ Thư viện Media Lily Chen Academy',
            button: { text: 'Sử dụng ảnh này' },
            multiple: false
          });

          mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#input_' + targetId).val(attachment.url);
            $('#preview_' + targetId).attr('src', attachment.url);
          });

          mediaUploader.open();
        });

        $('.reset-media-btn').on('click', function(e) {
          e.preventDefault();
          var targetId = $(this).data('target');
          var defaultUrl = $(this).data('default');
          $('#input_' + targetId).val(defaultUrl);
          $('#preview_' + targetId).attr('src', defaultUrl);
        });
      });
    </script>
    <?php
}
