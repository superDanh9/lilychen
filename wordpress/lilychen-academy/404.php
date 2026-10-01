<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="mainContent" class="site-main section-padding" style="min-height: 70vh; display: flex; align-items: center;">
  <div class="container" style="max-width: 720px; text-align: center; margin: 0 auto; padding: 40px 20px;">
    <div style="font-family: var(--font-heading); font-size: clamp(5rem, 14vw, 8.5rem); font-weight: 700; color: var(--color-rose); line-height: 1; margin-bottom: 10px; letter-spacing: -0.03em;">
      404
    </div>
    <span class="section-kicker" style="margin-bottom: 12px; display: inline-block;">Không Tìm Thấy Trang</span>
    <h1 style="font-family: var(--font-heading); font-size: clamp(1.8rem, 4vw, 2.4rem); color: var(--text-primary); margin-bottom: 18px; font-weight: 600;">
      Trang Bạn Đang Tìm Kiếm Hiện Không Khả Dụng
    </h1>
    <p style="color: var(--text-secondary); font-size: 1.05rem; line-height: 1.7; margin-bottom: 36px;">
      Đường dẫn có thể đã thay đổi hoặc trang đã được chuyển sang địa chỉ mới. Bạn có thể quay về trang chủ hoặc khám phá các nội dung nổi bật bên dưới.
    </p>

    <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
        <span>Về Trang Chủ</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/khoa-hoc/')); ?>" class="btn btn-secondary btn-lg">
        <span>Xem Khóa Học</span>
      </a>
      <a href="<?php echo esc_url(home_url('/tac-pham-hoc-vien/')); ?>" class="btn btn-secondary btn-lg">
        <span>Xem Tác Phẩm</span>
      </a>
    </div>
  </div>
</main>

<?php
get_footer();
