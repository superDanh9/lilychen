<?php
/**
 * The template for displaying archive pages
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="mainContent" class="site-main section-padding">
  <div class="container" style="max-width: 1200px;">
    <header class="archive-header" style="text-align: center; margin-bottom: 50px;">
      <span class="section-kicker"><?php esc_html_e('Chuyên Mục', 'lilychen-academy'); ?></span>
      <h1 class="section-title" style="margin-top: 10px;"><?php the_archive_title(); ?></h1>
      <?php the_archive_description('<div class="archive-description" style="color: var(--text-secondary); max-width: 650px; margin: 15px auto 0; font-size: 1.05rem; line-height: 1.6;">', '</div>'); ?>
    </header>

    <?php if (have_posts()) : ?>
      <div class="blog-grid">
        <?php
        while (have_posts()) : the_post();
            $categories = get_the_category();
            $cat_name   = !empty($categories) ? $categories[0]->name : 'Kiến thức Makeup';
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
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
                <h2 class="blog-title" style="font-size: 1.25rem;">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p class="blog-excerpt">
                  <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22, '...')); ?>
                </p>
                <div class="blog-footer">
                  <a href="<?php the_permalink(); ?>" class="blog-read-more">
                    <span><?php esc_html_e('Đọc tiếp', 'lilychen-academy'); ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </a>
                </div>
              </div>
            </article>
            <?php
        endwhile;
        ?>
      </div>

      <div class="pagination-wrap" style="text-align: center; margin-top: 60px;">
        <?php
        the_posts_pagination(array(
            'prev_text' => '&larr; Trước',
            'next_text' => 'Sau &rarr;',
            'mid_size'  => 2,
        ));
        ?>
      </div>
    <?php else : ?>
      <div class="no-posts-card" style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; box-shadow: var(--shadow-sm);">
        <h3 style="font-family: var(--font-heading); color: var(--text-primary); margin-bottom: 12px;"><?php esc_html_e('Chưa có bài viết trong chuyên mục này', 'lilychen-academy'); ?></h3>
        <p style="color: var(--text-secondary); margin-bottom: 24px;"><?php esc_html_e('Các bài viết đang được biên soạn. Vui lòng quay lại sau.', 'lilychen-academy'); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
          <span><?php esc_html_e('Về trang chủ', 'lilychen-academy'); ?></span>
        </a>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
