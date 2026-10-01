<?php
/**
 * Template part for displaying posts in blog grid
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

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
