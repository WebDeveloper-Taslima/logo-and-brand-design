<?php
/**
 * IRON & LEAF CULTIVATION CO. - CUSTOM POST TYPE: CANNABIS STRAINS
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Type: Strains
 */
function iron_leaf_register_strain_cpt() {
    $labels = [
        'name'                  => _x('Strains', 'Post Type General Name', 'iron-and-leaf'),
        'singular_name'         => _x('Strain', 'Post Type Singular Name', 'iron-and-leaf'),
        'menu_name'             => __('Cannabis Vault', 'iron-and-leaf'),
        'all_items'             => __('All Strains', 'iron-and-leaf'),
        'add_new_item'          => __('Add New Strain', 'iron-and-leaf'),
        'add_new'               => __('Add Strain', 'iron-and-leaf'),
        'new_item'              => __('New Strain', 'iron-and-leaf'),
        'edit_item'             => __('Edit Strain', 'iron-and-leaf'),
        'update_item'           => __('Update Strain', 'iron-and-leaf'),
        'view_item'             => __('View Strain', 'iron-and-leaf'),
        'search_items'          => __('Search Strains', 'iron-and-leaf'),
    ];

    $args = [
        'label'                 => __('Strain', 'iron-and-leaf'),
        'description'           => __('Locally Cultivated Cannabis Strains', 'iron-and-leaf'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
        'taxonomies'            => ['strain_type'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-palmtree',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    ];

    register_post_type('strain', $args);

    // Register Taxonomy: Strain Type (Indica, Sativa, Hybrid)
    $tax_labels = [
        'name'              => _x('Strain Types', 'taxonomy general name', 'iron-and-leaf'),
        'singular_name'     => _x('Strain Type', 'taxonomy singular name', 'iron-and-leaf'),
        'search_items'      => __('Search Strain Types', 'iron-and-leaf'),
        'all_items'         => __('All Strain Types', 'iron-and-leaf'),
        'edit_item'         => __('Edit Strain Type', 'iron-and-leaf'),
        'update_item'       => __('Update Strain Type', 'iron-and-leaf'),
        'add_new_item'      => __('Add New Strain Type', 'iron-and-leaf'),
        'new_item_name'     => __('New Strain Type Name', 'iron-and-leaf'),
        'menu_name'         => __('Strain Types', 'iron-and-leaf'),
    ];

    register_taxonomy('strain_type', ['strain'], [
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'strain-type'],
        'show_in_rest'      => true,
    ]);
}
add_action('init', 'iron_leaf_register_strain_cpt', 0);

/**
 * Add Meta Box for Strain Laboratory & Potency Metrics
 */
function iron_leaf_add_strain_meta_box() {
    add_meta_box(
        'strain_potency_details',
        __('Laboratory Metrics & Terpenes (Web Security Verified)', 'iron-and-leaf'),
        'iron_leaf_render_strain_meta_box',
        'strain',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'iron_leaf_add_strain_meta_box');

function iron_leaf_render_strain_meta_box($post) {
    // Nonce field for CSRF security protection in WordPress
    wp_nonce_field('iron_leaf_save_strain_meta', 'iron_leaf_strain_nonce');

    $thc = get_post_meta($post->ID, '_strain_thc', true);
    $cbd = get_post_meta($post->ID, '_strain_cbd', true);
    $lineage = get_post_meta($post->ID, '_strain_lineage', true);
    $terpenes = get_post_meta($post->ID, '_strain_terpenes', true);
    $batch = get_post_meta($post->ID, '_strain_batch', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="strain_thc"><?php _e('THC Potency %', 'iron-and-leaf'); ?></label></th>
            <td><input type="text" id="strain_thc" name="strain_thc" value="<?php echo esc_attr($thc); ?>" placeholder="e.g. 31.4%" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="strain_cbd"><?php _e('CBD %', 'iron-and-leaf'); ?></label></th>
            <td><input type="text" id="strain_cbd" name="strain_cbd" value="<?php echo esc_attr($cbd); ?>" placeholder="e.g. 0.4%" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="strain_lineage"><?php _e('Genetic Lineage', 'iron-and-leaf'); ?></label></th>
            <td><input type="text" id="strain_lineage" name="strain_lineage" value="<?php echo esc_attr($lineage); ?>" placeholder="e.g. Ghost OG × Motorbreath #15" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="strain_terpenes"><?php _e('Dominant Terpenes', 'iron-and-leaf'); ?></label></th>
            <td><input type="text" id="strain_terpenes" name="strain_terpenes" value="<?php echo esc_attr($terpenes); ?>" placeholder="e.g. Caryophyllene, Myrcene, Limonene" class="large-text"></td>
        </tr>
        <tr>
            <th><label for="strain_batch"><?php _e('Batch / Track Code', 'iron-and-leaf'); ?></label></th>
            <td><input type="text" id="strain_batch" name="strain_batch" value="<?php echo esc_attr($batch); ?>" placeholder="e.g. IL-IND-2026-09A" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

/**
 * Save Strain Meta with strict CSRF verification and sanitization
 */
function iron_leaf_save_strain_meta($post_id) {
    if (!isset($_POST['iron_leaf_strain_nonce']) || !wp_verify_nonce($_POST['iron_leaf_strain_nonce'], 'iron_leaf_save_strain_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = ['strain_thc', 'strain_cbd', 'strain_lineage', 'strain_terpenes', 'strain_batch'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_strain', 'iron_leaf_save_strain_meta');
