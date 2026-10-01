<?php
/**
 * The template for displaying all single posts
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="mainContent" class="site-main section-padding">
  <div class="container" style="max-width: 860px; margin: 0 auto; padding: 0 20px;">
    <?php
    while (have_posts()) : the_post();
        $categories = get_the_category();
        $cat_name   = !empty($categories) ? $categories[0]->name : 'Kiến thức Makeup';
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
          <!-- Article Header -->
          <header class="article-header" style="text-align: center; margin-bottom: 36px;">
            <div style="margin-bottom: 14px;">
              <span class="blog-cat-badge"><?php echo esc_html($cat_name); ?></span>
            </div>
            <h1 class="article-title" style="font-family: var(--font-heading); font-size: clamp(1.8rem, 4vw, 2.5rem); font-weight: 700; color: var(--text-primary); line-height: 1.3; margin-bottom: 18px;">
              <?php the_title(); ?>
            </h1>
            <div class="article-meta" style="color: var(--text-muted); font-size: 0.92rem; display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;">
              <span><?php echo esc_html(get_the_date('d \T\h\á\n\g m, Y')); ?></span>
              <span>·</span>
              <span>Tác giả: <strong><?php the_author(); ?></strong></span>
            </div>
          </header>

          <!-- Featured Image -->
          <?php if (has_post_thumbnail()) : ?>
            <div class="article-featured-img" style="margin-bottom: 40px; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-md);">
              <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; display: block;')); ?>
            </div>
          <?php endif; ?>

          <!-- Article Body -->
          <div class="article-body-content" style="font-size: 1.05rem; line-height: 1.85; color: var(--text-secondary);">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links" style="margin: 30px 0; font-weight: 600;">' . esc_html__('Trang:', 'lilychen-academy'),
                'after'  => '</div>',
            ));
            ?>
          </div>

          <!-- Article Footer / Author Box -->
          <footer class="article-footer" style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--border-subtle);">
            <div class="author-bio-card" style="display: flex; gap: 20px; align-items: center; background: #fff; padding: 24px; border-radius: 12px; border: 1px solid var(--border-hairline);">
              <img src="<?php echo esc_url(lilychen_image_url('IMG_1683.webp')); ?>" alt="Master Lily Chen" style="width: 72px; height: 72px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">
              <div>
                <div style="font-weight: 700; color: var(--text-primary); font-size: 1.05rem;">Lily Chen (Nguyễn Phương Ly)</div>
                <div style="font-size: 0.88rem; color: var(--color-rose); margin-bottom: 6px;">Master Makeup Artist & Giảng viên sáng lập</div>
                <p style="font-size: 0.92rem; color: var(--text-secondary); line-height: 1.5; margin: 0;">
                  Hơn 6 năm kinh nghiệm đào tạo thực chiến tại Bình Dương. Trực tiếp uốn nắn từng nét cọ cho hơn 200+ học viên.
                </p>
              </div>
            </div>

            <!-- Previous / Next Navigation -->
            <nav class="post-nav-links" style="display: flex; justify-content: space-between; gap: 20px; margin-top: 36px; flex-wrap: wrap;">
              <div class="nav-prev">
                <?php previous_post_link('%link', '&larr; %title'); ?>
              </div>
              <div class="nav-next">
                <?php next_post_link('%link', '%title &rarr;'); ?>
              </div>
            </nav>
          </footer>
        </article>
        <?php
    endwhile;
    ?>
  </div>
</main>

<?php
get_footer();
