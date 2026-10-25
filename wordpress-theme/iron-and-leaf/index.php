<?php
/**
 * IRON & LEAF CULTIVATION CO. - MAIN INDEX FALLBACK
 */
get_header();
?>
<main class="container" style="padding: 10rem 0 5rem 0;">
  <h1><?php the_title(); ?></h1>
  <div>
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_content();
      endwhile;
    endif;
    ?>
  </div>
</main>
<?php
get_footer();
