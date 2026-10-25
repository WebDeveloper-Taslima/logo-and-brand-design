<?php
/**
 * IRON & LEAF CULTIVATION CO. - THEME FOOTER
 */
?>
<!-- Strain Modal -->
<div id="strainModal" class="modal-overlay" role="dialog" aria-modal="true">
  <div class="modal-box">
    <button id="modalCloseBtn" class="modal-close" aria-label="Close dialog">&times;</button>
    <div id="modalContentBody"></div>
  </div>
</div>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-badge.svg'); ?>" alt="Iron and Leaf Emblem" style="width: 42px; height: 42px;">
          <span style="font-family: var(--font-heading); font-size: 1.5rem; letter-spacing: 2px;"><?php bloginfo('name'); ?></span>
        </div>
        <p>
          An outlaw motorcycle craft cannabis collective. Locally cultivated in state-licensed living organic soil micro-rooms.
        </p>
        <div style="margin-top: 1rem; color: #f59e0b; font-size: 0.85rem; font-weight: bold;">
          📍 Facility: Bay County Industrial Park &bull; Lic #IL-MC-8849-GROW
        </div>
      </div>

      <div class="footer-col">
        <h4>Navigation</h4>
        <ul>
          <li><a href="#strains">Current Strains</a></li>
          <li><a href="#cultivation">Grow Process</a></li>
          <li><a href="#brotherhood">The Brotherhood</a></li>
          <li><a href="#compliance">Lab Results (COA)</a></li>
          <li><a href="#contact">Wholesale Portal</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Legal &amp; Security</h4>
        <ul>
          <li><a href="javascript:void(0)" onclick="localStorage.removeItem('iron_leaf_age_verified'); location.reload();">Reset Age Verification</a></li>
          <li><a href="#compliance">Seed-to-Sale Tracking</a></li>
          <li><a href="#compliance">Web Security Protocol</a></li>
        </ul>
      </div>
    </div>

    <!-- Mandatory Legal Cannabis Warning -->
    <div class="compliance-disclaimer">
      <strong>LEGAL DISCLAIMER &amp; WARNING:</strong> 
      For use only by adults twenty-one years of age and older (or individuals eighteen years of age or older with a valid medical recommendation). Keep out of reach of children and pets. Cannabis products have intoxicating effects and may be habit-forming. Do not operate a vehicle or machinery under the influence of cannabis.
    </div>

    <div class="footer-bottom">
      &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved. Hardened with WordPress Security Standards.
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
