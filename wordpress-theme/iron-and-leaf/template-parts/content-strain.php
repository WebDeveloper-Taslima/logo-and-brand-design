<?php
/**
 * IRON & LEAF CULTIVATION CO. - STRAIN CARD TEMPLATE PART
 */
$thc = get_post_meta(get_the_ID(), '_strain_thc', true) ?: '30.0%';
$cbd = get_post_meta(get_the_ID(), '_strain_cbd', true) ?: '0.5%';
$lineage = get_post_meta(get_the_ID(), '_strain_lineage', true) ?: 'Proprietary Biker Breed';
$terpenes = get_post_meta(get_the_ID(), '_strain_terpenes', true) ?: 'Caryophyllene, Myrcene';
$batch = get_post_meta(get_the_ID(), '_strain_batch', true) ?: 'IL-RES-2026';

$terms = get_the_terms(get_the_ID(), 'strain_type');
$type_slug = !empty($terms) ? $terms[0]->slug : 'indica';
$type_name = !empty($terms) ? $terms[0]->name : 'Heavy Indica';

$badge_class = 'badge-' . $type_slug;
?>

<div class="strain-card glass-panel">
  <span class="strain-badge-top <?php echo esc_attr($badge_class); ?>"><?php echo esc_html($type_name); ?></span>
  <div class="strain-img-wrap">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('medium_large'); ?>
    <?php else : ?>
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/craft-buds.jpg'); ?>" alt="<?php the_title_attribute(); ?>">
    <?php endif; ?>
  </div>
  <div class="strain-body">
    <h3 class="strain-name"><?php the_title(); ?></h3>
    <div class="strain-lineage"><?php echo esc_html($lineage); ?></div>
    <div class="strain-potency-bar">
      <div class="potency-metric">
        <div class="val"><?php echo esc_html($thc); ?></div>
        <div class="lbl">THC Potency</div>
      </div>
      <div class="potency-metric">
        <div class="val"><?php echo esc_html($cbd); ?></div>
        <div class="lbl">CBD</div>
      </div>
      <div class="potency-metric">
        <div class="val">COA ✓</div>
        <div class="lbl">Lab Verified</div>
      </div>
    </div>
    <div class="strain-terpenes">
      <span class="terp-chip">🧪 <?php echo esc_html($terpenes); ?></span>
    </div>
    <div style="font-size:0.85rem; margin-bottom:1.25rem;">
      <?php the_excerpt(); ?>
    </div>
    <div class="strain-footer">
      <div class="coa-verified">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        <span>Batch <?php echo esc_html($batch); ?></span>
      </div>
      <button class="btn btn-outline" style="font-size:0.9rem; padding:0.4rem 0.9rem;" onclick="openStrainDetails('chopper-og')">Batch Specs</button>
    </div>
  </div>
</div>
