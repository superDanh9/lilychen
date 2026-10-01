<?php
/**
 * The Header for Lily Chen Academy Theme
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  
  <!-- Preconnect to Google Fonts for optimal performance & LCP -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ========================================================
       STICKY NAVIGATION HEADER (APPROVED MINIMALIST NAVIGATION)
       ======================================================== -->
  <header class="site-header" id="siteHeader">
    <div class="container nav-container">
      <!-- Brand Logo -->
      <?php if (has_custom_logo()) : ?>
        <div class="site-logo-wrap">
          <?php the_custom_logo(); ?>
        </div>
      <?php else : ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
          <span class="logo-primary">LILY CHEN</span>
          <span class="logo-sub">MAKEUP ACADEMY</span>
        </a>
      <?php endif; ?>

      <!-- Desktop Nav Links -->
      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu(array(
              'theme_location' => 'primary',
              'container'      => 'nav',
              'container_class'=> 'desktop-nav',
              'menu_class'     => 'desktop-nav-list',
              'fallback_cb'    => 'lilychen_primary_menu_fallback',
              'depth'          => 2,
          ));
      } else {
          lilychen_primary_menu_fallback();
      }
      ?>

      <!-- Right Header Actions -->
      <div class="header-actions">
        <a href="<?php echo esc_url(home_url('/#dang-ky')); ?>" class="btn-consult">
          <span>Đăng Ký Tư Vấn</span>
        </a>

        <!-- Mobile Hamburger Button -->
        <button type="button" class="mobile-toggle" id="mobileToggle" aria-label="<?php esc_attr_e('Mở menu điều hướng', 'lilychen-academy'); ?>" aria-expanded="false" aria-controls="mobileDrawer">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile Navigation Drawer -->
  <div class="mobile-drawer" id="mobileDrawer" aria-label="<?php esc_attr_e('Menu di động', 'lilychen-academy'); ?>">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <div class="drawer-content">
      <div class="drawer-header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo">
          <span class="logo-primary">LILY CHEN</span>
          <span class="logo-sub">MAKEUP ACADEMY</span>
        </a>
        <button type="button" class="drawer-close" id="drawerClose" aria-label="<?php esc_attr_e('Đóng menu', 'lilychen-academy'); ?>">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>

      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu(array(
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class'     => 'mobile-nav-list',
              'fallback_cb'    => 'lilychen_mobile_menu_fallback',
              'depth'          => 2,
          ));
      } else {
          lilychen_mobile_menu_fallback();
      }
      ?>

      <div class="drawer-footer">
        <a href="<?php echo esc_url(home_url('/#dang-ky')); ?>" class="btn btn-primary btn-block">
          <span>Đăng Ký Tư Vấn</span>
        </a>
      </div>
    </div>
  </div>
