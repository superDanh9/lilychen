<?php
/**
 * The template for displaying all pages
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<main id="mainContent" class="site-main section-padding">
  <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">
    <?php
    while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-entry'); ?>>
          <header class="page-entry-header" style="text-align: center; margin-bottom: 40px;">
            <h1 class="page-entry-title" style="font-family: var(--font-heading); font-size: clamp(2rem, 4vw, 2.75rem); color: var(--text-primary); font-weight: 700;">
              <?php the_title(); ?>
            </h1>
          </header>

          <?php if (has_post_thumbnail()) : ?>
            <div class="page-featured-img" style="margin-bottom: 36px; border-radius: 12px; overflow: hidden;">
              <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; display: block;')); ?>
            </div>
          <?php endif; ?>

          <div class="page-entry-content" style="font-size: 1.05rem; line-height: 1.85; color: var(--text-secondary);">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Trang:', 'lilychen-academy'),
                'after'  => '</div>',
            ));
            ?>
          </div>
        </article>
        <?php
    endwhile;
    ?>
  </div>
</main>

<?php
get_footer();
