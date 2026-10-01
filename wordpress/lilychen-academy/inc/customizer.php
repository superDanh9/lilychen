<?php
/**
 * WordPress Customizer Integration for Lily Chen Academy Theme
 * Keeps customizer clean and avoids duplicate settings with the Editor Content Admin page.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

function lilychen_customize_register($wp_customize) {
    // Section pointing to unified Editor Admin panel
    $wp_customize->add_section('lilychen_home_content_guide', array(
        'title'       => __('Nội Dung Trang Chủ & Khóa Học', 'lilychen-academy'),
        'description' => sprintf(
            __('Toàn bộ nội dung trang chủ, khóa học, hình ảnh và thông tin liên hệ được quản lý tập trung và thống nhất tại mục <a href="%s" style="font-weight: bold; text-decoration: underline;">Nội Dung Trang Chủ</a> trong Bảng tin quản trị (hỗ trợ phân quyền chuẩn cho cả Editor và Administrator). Việc tập trung này đảm bảo tính nhất quán của dữ liệu và tránh xung đột hai nơi lưu hai giá trị khác nhau.', 'lilychen-academy'),
            esc_url(admin_url('admin.php?page=lilychen-home-content'))
        ),
        'priority'    => 30,
    ));

    // Notice setting
    $wp_customize->add_setting('lilychen_guide_dummy', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'lilychen_guide_dummy', array(
        'section'     => 'lilychen_home_content_guide',
        'type'        => 'hidden',
    )));
}
add_action('customize_register', 'lilychen_customize_register');
