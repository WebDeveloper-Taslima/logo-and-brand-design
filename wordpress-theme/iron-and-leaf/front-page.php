<?php
/**
 * IRON & LEAF CULTIVATION CO. - FRONTPAGE TEMPLATE
 */
get_header();
?>

<!-- HERO SECTION -->
<header id="home" class="hero-section">
  <div class="hero-backdrop" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-bg.jpg'); ?>');"></div>
  <div class="hero-overlay"></div>

  <div class="container hero-content">
    <div class="hero-badge-tag">
      <span>🏍️ Motor Club Heritage &bull; 100% Local Micro-Grow</span>
    </div>

    <h1 class="hero-title">
      BORN ON THE ROAD. <br>
      <span class="text-gradient">GROWN IN THE DIRT.</span>
    </h1>

    <p class="hero-desc">
      We swapped highway asphalt for organic living soil. Iron &amp; Leaf is an independent craft cannabis collective founded by an outlaw motorcycle crew. Micro-batch grown, terpene-dense, and slow cold-cured for true connoisseurs.
    </p>

    <div class="hero-actions">
      <a href="#strains" class="btn btn-primary">
        <span>🔥 Explore Current Harvest</span>
      </a>
      <a href="#contact" class="btn btn-outline">
        <span>Wholesale &amp; Pre-Orders</span>
      </a>
    </div>

    <div class="stats-banner">
      <div class="stat-box glass-panel">
        <div class="stat-number green-text">33.1%</div>
        <div class="stat-label">Peak THC Potency</div>
      </div>
      <div class="stat-box glass-panel">
        <div class="stat-number gold-text">45 DAYS</div>
        <div class="stat-label">Cold Vault Cure</div>
      </div>
      <div class="stat-box glass-panel">
        <div class="stat-number">100%</div>
        <div class="stat-label">Organic Living Soil</div>
      </div>
      <div class="stat-box glass-panel">
        <div class="stat-number green-text">ZERO</div>
        <div class="stat-label">Synthetic Pesticides</div>
      </div>
    </div>
  </div>
</header>

<!-- STRAIN CATALOG SECTION -->
<section id="strains" class="catalog-section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Direct From The Vault</span>
      <h2>THE HARVEST <span class="green-text">LINEUP</span></h2>
      <p>
        Heavy gas, rare landrace genetics, and exotic dessert cuts bred and cured inside our climate-controlled local grow facility.
      </p>
    </div>

    <div class="strain-filters">
      <button class="filter-btn active" data-filter="all">All Strains</button>
      <button class="filter-btn" data-filter="indica">Heavy Indica</button>
      <button class="filter-btn" data-filter="sativa">Rebel Sativa</button>
      <button class="filter-btn" data-filter="hybrid">Exotic Hybrid</button>
    </div>

    <!-- Strain Grid Hooked with CPT Fallback -->
    <div id="strainGrid" class="strain-grid">
      <?php
      $args = [
        'post_type'      => 'strain',
        'posts_per_page' => 6,
        'post_status'    => 'publish'
      ];
      $strain_query = new WP_Query($args);

      if ($strain_query->have_posts()) :
        while ($strain_query->have_posts()) : $strain_query->the_post();
          get_template_part('template-parts/content', 'strain');
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</section>

<!-- CULTIVATION METHOD -->
<section id="cultivation" class="about-section">
  <div class="container">
    <div class="about-grid">
      <div class="about-text">
        <span class="section-tag">Our Facility &amp; Standards</span>
        <h2>THE OUTLAW <span class="gold-text">METHOD</span></h2>
        <p style="margin-bottom: 1.5rem; font-size: 1.1rem; color: #d1d5db;">
          Corporate cannabis cuts corners. We do not. Our brotherhood applies military discipline and mechanical precision to craft horticulture.
        </p>

        <div class="process-steps">
          <div class="step-card glass-panel">
            <div class="step-number">01</div>
            <div class="step-content">
              <h4>Heritage Clone &amp; Landrace Cuts</h4>
              <p>We source authentic genetic cuts from underground breeders, veterans, and motorcycle runs dating back thirty years.</p>
            </div>
          </div>

          <div class="step-card glass-panel">
            <div class="step-number">02</div>
            <div class="step-content">
              <h4>No-Till Living Organic Soil</h4>
              <p>Our plants feed on rich worm castings, mycorrhizae, kelp, and volcanic rock dust. Pure nature, maximum terpene expression.</p>
            </div>
          </div>

          <div class="step-card glass-panel">
            <div class="step-number">03</div>
            <div class="step-content">
              <h4>45-Day Low-Temp Cold Curing</h4>
              <p>Buds are hand-trimmed and cured in sealed stainless steel vaults at 60°F / 60% humidity to lock in volatile aromatic monoterpenes.</p>
            </div>
          </div>

          <div class="step-card glass-panel">
            <div class="step-number">04</div>
            <div class="step-content">
              <h4>Batch Lab Verification &amp; Full COA</h4>
              <p>Every single drop is tested by state certified third-party testing labs. Zero heavy metals, zero molds, pure clean smoke.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="about-badge-wrap">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/craft-buds.jpg'); ?>" alt="Frosty Craft Cannabis Buds">
        <div style="margin-top: 1.5rem;">
          <div class="hero-badge-tag" style="background: rgba(16, 185, 129, 0.15); border-color: #10b981; color: #6ee7b7;">
            ✓ Hand Trimmed &bull; Glass Jar Sealed
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- BROTHERHOOD SECTION -->
<section id="brotherhood" class="catalog-section" style="background: #090a0d;">
  <div class="container">
    <div class="about-grid">
      <div class="about-badge-wrap">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/iron-and-leaf-logo.jpg'); ?>" alt="Iron and Leaf Brotherhood Crest">
      </div>

      <div class="about-text">
        <span class="section-tag">Honor, Brotherhood, Craft</span>
        <h2>FROM CHOPPERS <span class="green-text">TO CROPS</span></h2>
        <p style="margin-bottom: 1.25rem;">
          Our club was forged through decades of open highway rides, wrenching on vintage V-twins, and standing shoulder to shoulder. When legalization unlocked local craft cultivation, our crew channeled our shared dedication into building our state's most uncompromising craft grow facility.
        </p>
        <p style="margin-bottom: 2rem;">
          We don't answer to Wall Street venture capitalists or corporate conglomerates. We answer to the riders, the veterans, and the local patients who rely on clean, unadulterated flower.
        </p>

        <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
          <div>
            <div class="gold-text" style="font-family: var(--font-heading); font-size: 1.8rem;">100% INDEPENDENT</div>
            <p style="font-size: 0.85rem;">Veteran &amp; Rider Owned</p>
          </div>
          <div>
            <div class="green-text" style="font-family: var(--font-heading); font-size: 1.8rem;">COMMUNITY ROOTS</div>
            <p style="font-size: 0.85rem;">Local Jobs &amp; Taxes Reinvested</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECURITY & COMPLIANCE -->
<section id="compliance" class="security-banner">
  <div class="container">
    <div class="security-grid">
      <div class="security-item">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
        <h4>Strict 21+ Age Gate</h4>
        <p>Verified browser persistence &amp; strict legal compliance defense.</p>
      </div>

      <div class="security-item">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
        <h4>WordPress Hardened</h4>
        <p>XML-RPC blocked, user enumeration blocked, nonces enforced.</p>
      </div>

      <div class="security-item">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
        <h4>Seed-To-Sale Tracked</h4>
        <p>State compliance traceability integration on all batch manifests.</p>
      </div>

      <div class="security-item">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <h4>Third-Party Tested</h4>
        <p>Full Certificate of Analysis (COA) for pesticides, microbes &amp; potency.</p>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT & WHOLESALE PRE-ORDER FORM -->
<section id="contact" class="contact-section">
  <div class="container">
    <div class="contact-card glass-panel">
      <div class="section-header" style="margin-bottom: 2rem;">
        <span class="section-tag">Direct Dispensary Transmission</span>
        <h2>WHOLESALE &amp; <span class="gold-text">VIP DISPATCH</span></h2>
        <p>
          Licensed dispensaries, provisioning centers, and verified members can request drop allocations or schedule facility walkthroughs.
        </p>
      </div>

      <form id="inquiryForm" class="contact-form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST">
        <input type="hidden" name="action" value="iron_inquiry">
        <input type="hidden" name="csrf_token" id="csrfTokenInput" value="<?php echo wp_create_nonce('iron_leaf_secure_inquiry_nonce'); ?>">
        <input type="text" name="biker_secret_field" class="ohnohoney" tabindex="-1" autocomplete="off">

        <div class="form-group">
          <label for="fullname">Representative Name *</label>
          <input type="text" id="fullname" name="fullname" class="form-control" placeholder="e.g. Jax Teller" required maxlength="100">
        </div>

        <div class="form-group">
          <label for="email">Business / Personal Email *</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="jax@rebeldispensary.com" required maxlength="100">
        </div>

        <div class="form-group">
          <label for="phone">Direct Phone</label>
          <input type="tel" id="phone" name="phone" class="form-control" placeholder="(555) 019-2834" maxlength="30">
        </div>

        <div class="form-group">
          <label for="license_no">State Cannabis License # (If Wholesale)</label>
          <input type="text" id="license_no" name="license_no" class="form-control" placeholder="e.g. DISP-2026-9901" maxlength="50">
        </div>

        <div class="form-group form-group-full">
          <label for="inquiry_type">Inquiry Classification</label>
          <select id="inquiry_type" name="inquiry_type" class="form-control">
            <option value="wholesale">Licensed Dispensary Wholesale Allocation</option>
            <option value="dispensary">Retail Shelf Placement Inquiry</option>
            <option value="vip_crew">VIP Crew / Drop Alert Notification</option>
            <option value="cultivation_inquiry">Genetic / Cultivation Collaboration</option>
            <option value="general">General Transmission</option>
          </select>
        </div>

        <div class="form-group form-group-full">
          <label for="message">Transmission Message *</label>
          <textarea id="message" name="message" class="form-control" placeholder="Detail your wholesale volume request, strain preference, or questions..." required maxlength="2500"></textarea>
        </div>

        <div class="form-group form-group-full" style="text-align: center;">
          <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.1rem;">
            <span>⚡ Transmit Encrypted Dispatch</span>
          </button>
          <p class="form-notice">
            🛡️ Protected by WordPress nonces, honeypot filters, and rate-limiting protocols.
          </p>
        </div>
      </form>
    </div>
  </div>
</section>

<?php
get_footer();
