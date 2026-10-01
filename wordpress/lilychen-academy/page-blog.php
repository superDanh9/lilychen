<?php
/**
 * Template Name: Blog & Cẩm Nang
 * Template Post Type: page
 *
 * Mẫu trang Blog / Tin tức / Cẩm nang làm đẹp của Lily Chen Academy.
 * Tái hiện 100% thiết kế giao diện đã duyệt,
 * lọc toàn bộ bài viết theo chuyên mục WordPress thực tế,
 * hỗ trợ phân trang chuẩn xác trong kết quả lọc,
 * bảo vệ fallback ảnh an toàn và không ghi đè dữ liệu quản trị.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

// 1. Xác định chuyên mục đang lọc qua query parameter hoặc rewrite query var
$current_cat_slug = '';
if (!empty($_GET['cat_slug'])) {
    $current_cat_slug = sanitize_title(wp_unslash($_GET['cat_slug']));
} elseif (get_query_var('category_name')) {
    $current_cat_slug = sanitize_title(get_query_var('category_name'));
}

// 2. Xử lý phân trang chuẩn WordPress
$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

// 3. Số lượng bài viết trên mỗi trang
$posts_per_page = get_option('posts_per_page', 9);

// 4. Thiết lập truy vấn danh sách bài viết theo chuyên mục WordPress thực tế
$blog_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_page,
    'paged'          => $paged,
);

if (!empty($current_cat_slug) && $current_cat_slug !== 'all') {
    $blog_args['category_name'] = $current_cat_slug;
}

$blog_query = new WP_Query($blog_args);

// 5. Lấy danh sách toàn bộ chuyên mục thực tế trong database WordPress (không dùng slug map)
$all_categories = get_categories(array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => true,
));

// Tổng số bài viết đã xuất bản
$total_posts_count = wp_count_posts('post')->publish;

// 6. Bài viết nổi bật (Featured Spotlight) - chỉ hiển thị trên trang 1 khi xem Tất Cả
$featured_post = null;
if ($paged <= 1 && (empty($current_cat_slug) || $current_cat_slug === 'all')) {
    $sticky_posts = get_option('sticky_posts');
    if (!empty($sticky_posts)) {
        $feat_args = array(
            'post__in'            => $sticky_posts,
            'posts_per_page'      => 1,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
        );
    } else {
        $feat_args = array(
            'posts_per_page'      => 1,
            'post_status'         => 'publish',
        );
    }
    $feat_query = new WP_Query($feat_args);
    if ($feat_query->have_posts()) {
        $feat_query->the_post();
        $featured_post = get_post();
        wp_reset_postdata();
    }
}

// Đường dẫn trang Blog cơ sở
$blog_base_url = home_url('/blog/');
$fallback_img_url = lilychen_image_url('nghe-makeup-co-tuong-lai-khong-featured.webp');
?>

<main id="mainContent">
  <!-- Page Hero Banner -->
  <section class="page-hero">
    <canvas id="blogHeroCanvas" class="particle-canvas page-hero-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
    <div class="container">
      <span class="page-hero-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
        Góc Chia Sẻ Chuyên Môn &amp; Nghề Nghiệp
      </span>
      <h1 class="page-hero-title">Blog &amp; Cẩm Nang Làm Đẹp Độc Bản</h1>
      <p class="page-hero-desc">
        Tổng hợp kiến thức trang điểm chuẩn chuyên gia, kỹ thuật xử lý da mụn - da dầu không bị cakey, và định hướng phát triển sự nghiệp vững chắc cho các bạn trẻ đam mê ngành làm đẹp.
      </p>
      <div class="page-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>">Trang Chủ</a>
        <span>/</span>
        <span>Blog &amp; Kiến Thức</span>
      </div>
    </div>
  </section>

  <!-- Main Blog Grid Section -->
  <section class="section-padding" style="background: #ffffff;">
    <div class="container">

      <?php if ($featured_post) : 
        $feat_id = $featured_post->ID;
        $feat_link = get_permalink($feat_id);
        $feat_title = get_the_title($feat_id);
        $feat_excerpt = get_the_excerpt($feat_id);
        if (empty($feat_excerpt)) {
            $feat_excerpt = wp_trim_words(strip_shortcodes($featured_post->post_content), 40, '...');
        }
        $feat_date = get_the_date('d/m/Y', $feat_id);
        $feat_author = get_the_author_meta('display_name', $featured_post->post_author);
        if (empty($feat_author)) { $feat_author = 'Master Lily Chen'; }
        
        $feat_cats = get_the_category($feat_id);
        $feat_cat_name = !empty($feat_cats) ? $feat_cats[0]->name : 'Bài Viết Nổi Bật';

        // Kiểm tra vật lý file ảnh đính kèm
        $feat_thumb_id = get_post_thumbnail_id($feat_id);
        $feat_file_valid = false;
        if ($feat_thumb_id) {
            $feat_attached = get_attached_file($feat_thumb_id);
            if ($feat_attached && file_exists($feat_attached)) {
                $feat_file_valid = true;
            }
        }
      ?>
      <!-- Featured Post Spotlight -->
      <article class="featured-blog-card">
        <div class="featured-thumb-wrap">
          <?php if ($feat_file_valid) : ?>
            <?php echo get_the_post_thumbnail($feat_id, 'large', array('class' => 'featured-thumb', 'loading' => 'lazy', 'alt' => esc_attr($feat_title))); ?>
          <?php else : ?>
            <img src="<?php echo esc_url($fallback_img_url); ?>" alt="<?php echo esc_attr($feat_title); ?>" class="featured-thumb" width="1200" height="675" loading="lazy">
          <?php endif; ?>
          <span class="blog-cat-badge"><?php echo esc_html($feat_cat_name); ?></span>
        </div>
        <div class="featured-blog-content">
          <div class="blog-meta">
            <span class="blog-date"><?php echo esc_html($feat_date); ?></span>
            <span class="blog-dot">·</span>
            <span class="blog-author"><?php echo esc_html($feat_author); ?></span>
            <span class="blog-dot">·</span>
            <span>7 phút đọc</span>
          </div>
          <h2 class="featured-blog-title">
            <a href="<?php echo esc_url($feat_link); ?>"><?php echo esc_html($feat_title); ?></a>
          </h2>
          <p class="blog-excerpt" style="-webkit-line-clamp: 4;">
            <?php echo esc_html($feat_excerpt); ?>
          </p>
          <div class="blog-footer">
            <a href="<?php echo esc_url($feat_link); ?>" class="btn btn-primary btn-sm">
              <span>Đọc Toàn Bộ Bài Viết</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          </div>
        </div>
      </article>
      <?php endif; ?>

      <!-- Category Filter Pills (Từ chuyên mục WordPress thực tế) -->
      <div class="gallery-filters" style="margin-bottom: 40px; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
        <a href="<?php echo esc_url($blog_base_url); ?>" class="gallery-filter-btn blog-filter-btn<?php echo (empty($current_cat_slug) || $current_cat_slug === 'all') ? ' active' : ''; ?>" style="display: inline-block; text-decoration: none;">
          Tất Cả Bài Viết (<?php echo esc_html((string)$total_posts_count); ?>)
        </a>
        <?php foreach ($all_categories as $cat) : 
          $is_cat_active = ($current_cat_slug === $cat->slug);
          $cat_link = add_query_arg('cat_slug', $cat->slug, $blog_base_url);
        ?>
          <a href="<?php echo esc_url($cat_link); ?>" class="gallery-filter-btn blog-filter-btn<?php echo $is_cat_active ? ' active' : ''; ?>" style="display: inline-block; text-decoration: none;">
            <?php echo esc_html($cat->name); ?> (<?php echo esc_html((string)$cat->count); ?>)
          </a>
        <?php endforeach; ?>
      </div>

      <!-- Real WordPress Blog Grid -->
      <?php if ($blog_query->have_posts()) : ?>
        <div class="blog-grid" style="margin-bottom: 50px;">
          <?php while ($blog_query->have_posts()) : $blog_query->the_post(); 
            $p_id = get_the_ID();
            $p_slug = get_post_field('post_name', $p_id);
            
            // Lấy chuyên mục thực tế từ WordPress Admin
            $post_cats = get_the_category($p_id);
            $card_cat_name = !empty($post_cats) ? $post_cats[0]->name : 'Kiến thức Makeup';
            
            $card_excerpt = get_the_excerpt();
            if (empty($card_excerpt)) {
                $card_excerpt = wp_trim_words(strip_shortcodes(get_the_content()), 26, '...');
            }

            // Kiểm tra vật lý file ảnh uploads
            $thumb_id = get_post_thumbnail_id($p_id);
            $has_valid_physical_file = false;
            if ($thumb_id) {
                $attached_file = get_attached_file($thumb_id);
                if ($attached_file && file_exists($attached_file)) {
                    $has_valid_physical_file = true;
                }
            }
          ?>
            <article class="blog-card" id="card-<?php echo esc_attr($p_slug); ?>">
              <div class="blog-thumb-wrap">
                <?php if ($has_valid_physical_file) : ?>
                  <?php the_post_thumbnail('medium_large', array(
                      'class'   => 'blog-thumb',
                      'loading' => 'lazy',
                      'alt'     => get_the_title(),
                      'onerror' => "this.onerror=null;this.src='" . esc_url($fallback_img_url) . "';"
                  )); ?>
                <?php else : ?>
                  <img src="<?php echo esc_url($fallback_img_url); ?>" alt="<?php the_title_attribute(); ?>" class="blog-thumb" loading="lazy" width="600" height="400">
                <?php endif; ?>
                <span class="blog-cat-badge"><?php echo esc_html($card_cat_name); ?></span>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="blog-date"><?php echo esc_html(get_the_date('d/m/Y')); ?></span>
                  <span class="blog-dot">·</span>
                  <span class="blog-author"><?php the_author(); ?></span>
                </div>
                <h3 class="blog-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <p class="blog-excerpt">
                  <?php echo esc_html($card_excerpt); ?>
                </p>
                <div class="blog-footer">
                  <a href="<?php the_permalink(); ?>" class="blog-read-more">
                    <span>Đọc tiếp</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </a>
                </div>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

        <!-- WordPress Pagination (Bảo toàn chuyên mục đang lọc) -->
        <div class="pagination-wrap" style="text-align: center; margin: 40px auto 60px;">
          <?php
          $big = 999999999;
          $paginate_args = array(
              'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
              'format'    => '?paged=%#%',
              'current'   => max(1, $paged),
              'total'     => $blog_query->max_num_pages,
              'prev_text' => '&larr; Trước',
              'next_text' => 'Sau &rarr;',
              'type'      => 'list',
              'end_size'  => 1,
              'mid_size'  => 2,
          );
          if (!empty($current_cat_slug) && $current_cat_slug !== 'all') {
              $paginate_args['add_args'] = array('cat_slug' => $current_cat_slug);
          }
          echo paginate_links($paginate_args);
          ?>
        </div>
        <?php wp_reset_postdata(); ?>

      <?php else : ?>
        <div style="text-align: center; padding: 60px 20px; background: var(--bg-surface); border-radius: var(--radius-card); margin-bottom: 50px;">
          <h3 style="font-family: var(--font-heading); color: var(--text-primary); margin-bottom: 12px;">Chưa Có Bài Viết Trong Chuyên Mục Này</h3>
          <p style="color: var(--text-secondary); max-width: 500px; margin: 0 auto 20px;">Không tìm thấy bài viết nào phù hợp với bộ lọc chuyên mục đã chọn.</p>
          <a href="<?php echo esc_url($blog_base_url); ?>" class="btn btn-primary"><span>Xem Tất Cả Bài Viết</span></a>
        </div>
      <?php endif; ?>

      <!-- Consultation Banner -->
      <div class="roadmap-cta-banner">
        <div class="roadmap-cta-content">
          <h3 class="roadmap-cta-title">Bạn muốn được tư vấn lộ trình học makeup phù hợp với năng lực cá nhân?</h3>
          <p class="roadmap-cta-sub">Master Lily Chen trực tiếp phân tích đặc điểm khuôn mặt, tư vấn phong cách và tặng bộ cọ cao cấp khi đăng ký khóa học sớm trong tháng.</p>
        </div>
        <div class="roadmap-cta-actions">
          <a href="<?php echo esc_url(home_url('/lien-he/#dang-ky')); ?>" class="btn btn-primary btn-lg" style="box-shadow: 0 4px 18px rgba(255, 141, 161, 0.4);">
            <span>Đăng Ký Tư Vấn Khóa Học Ngay</span>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="https://zalo.me/0889979791" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg" style="background: rgba(255, 255, 255, 0.12); color: #fff; border-color: rgba(255, 255, 255, 0.25);">
            <span>Chat Zalo 088 997 97 91</span>
          </a>
        </div>
      </div>

    </div>
  </section>
</main>

<?php
get_footer();
