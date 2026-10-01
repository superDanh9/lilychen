<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="no-posts-card" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; box-shadow: var(--shadow-sm); max-width: 600px; margin: 0 auto;">
  <h3 style="font-family: var(--font-heading); color: var(--text-primary); margin-bottom: 12px;"><?php esc_html_e('Chưa có bài viết nào', 'lilychen-academy'); ?></h3>
  <p style="color: var(--text-secondary); margin-bottom: 24px; line-height: 1.6;"><?php esc_html_e('Hiện tại nội dung đang được cập nhật. Bạn có thể quay lại trang chủ hoặc tìm kiếm nội dung khác.', 'lilychen-academy'); ?></p>
  <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
    <span><?php esc_html_e('Về trang chủ', 'lilychen-academy'); ?></span>
  </a>
</div>
