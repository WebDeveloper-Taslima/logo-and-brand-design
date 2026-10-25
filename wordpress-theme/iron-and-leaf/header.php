<?php
/**
 * IRON & LEAF CULTIVATION CO. - THEME HEADER
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-badge.svg'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- 21+ Age Verification Gate -->
<div id="ageGateModal" class="age-gate-overlay" role="dialog" aria-modal="true" aria-labelledby="ageGateTitle">
  <div class="age-gate-card">
    <div class="age-gate-logo">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/iron-and-leaf-logo.jpg'); ?>" alt="<?php bloginfo('name'); ?>">
    </div>
    <div class="hero-badge-tag" style="margin-bottom: 0.75rem;">Security &amp; Legal Gate</div>
    <h2 id="ageGateTitle">ARE YOU <span class="green-text">21 YEARS</span> OR OLDER?</h2>
    <p>
      Iron &amp; Leaf Cultivation Co. produces state-regulated craft cannabis products. 
      You must be at least 21 years of age to enter this site.
    </p>

    <div class="age-actions">
      <button id="btnAgeVerify" class="btn btn-primary">
        <span>⚡ Enter The Stash (21+)</span>
      </button>
      <button id="btnAgeReject" class="btn btn-outline">
        <span>Exit Portal</span>
      </button>
    </div>

    <div style="margin-bottom: 1.25rem;">
      <label style="font-size: 0.85rem; color: #9ca3af; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
        <input type="checkbox" id="rememberAgeCheck" checked style="accent-color: #10b981;">
        Remember my verification on this device (30 Days)
      </label>
    </div>

    <div class="age-legal">
      Strict Age Gate &bull; SSL 256-Bit Encrypted &bull; State License #IL-MC-8849-GROW
    </div>
  </div>
</div>

<!-- Header Navigation -->
<nav id="siteNav" class="site-nav">
  <div class="container nav-container">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-brand">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/iron-and-leaf-logo.jpg'); ?>" alt="<?php bloginfo('name'); ?>">
      <div class="brand-titles">
        <span class="title-main"><?php bloginfo('name'); ?></span>
        <span class="title-sub">CULTIVATION CO. &bull; M.C.</span>
      </div>
    </a>

    <ul id="navLinks" class="nav-links">
      <li><a href="#strains">The Reserve</a></li>
      <li><a href="#cultivation">Craft Method</a></li>
      <li><a href="#brotherhood">Brotherhood</a></li>
      <li><a href="#compliance">Security &amp; Labs</a></li>
      <li><a href="#contact" class="btn btn-primary" style="padding: 0.5rem 1.2rem; font-size: 1rem;">Dispensary Dispatch</a></li>
    </ul>

    <button id="mobileToggle" class="mobile-toggle" aria-label="Toggle Navigation">&#9776;</button>
  </div>
</nav>
