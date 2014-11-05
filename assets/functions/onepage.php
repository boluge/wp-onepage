<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */
if ( file_exists(  __DIR__ .'/cmb2/init.php' ) ) {
    require_once  __DIR__ .'/cmb2/init.php';
} elseif ( file_exists(  __DIR__ .'/CMB2/init.php' ) ) {
    require_once  bloginfo(  ) .'/CMB2/init.php';
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
    // Don't show this field if not in the cats category
    if ( ! has_tag( 'cats', $field->object_id ) ) {
        return false;
    }
    return true;
}

add_filter( 'cmb2_meta_boxes', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_sample_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'onepage_';

    /**
     * Sample metabox to demonstrate each field type included
     */
    $meta_boxes['test_metabox'] = array(
        'id'            => 'page_settings',
        'title'         => __( 'OnePage Paramètres', 'cmb2' ),
        'object_types'  => array( 'page' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
        'fields'        => array(
            array(
                'name'       => __( 'Test Text', 'cmb2' ),
                'desc'       => __( 'field description (optional)', 'cmb2' ),
                'id'         => $prefix . 'test_text',
                'type'       => 'text',
                'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
                // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
                // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
                // 'on_front'        => false, // Optionally designate a field to wp-admin only
                // 'repeatable'      => true,
            ),
            array(
                'name' => __( 'Titre alternatif', 'cmb2' ),
                'desc' => __( 'Titre alternatif', 'cmb2' ),
                'id'   => $prefix . 'alt_title',
                'type' => 'text_medium',
                // 'repeatable' => true,
            ),
            array(
                'name' => __( 'Sous Titre', 'cmb2' ),
                'desc' => __( 'Sous titre de la page', 'cmb2' ),
                'id'   => $prefix . 'subtitle',
                'type' => 'text_medium',
                // 'repeatable' => true,
            ),
            array(
                'name' => __( 'Masquer le Titre', 'cmb2' ),
                'desc' => __( 'Cocher pour ne pas afficher pas le titre', 'cmb2' ),
                'id'   => $prefix . 'disable_title',
                'type' => 'checkbox',
            ),
            array(
                'name' => __( 'One Page', 'cmb2' ),
                'desc' => __( 'Cocher pour afficher cet article sur la one page', 'cmb2' ),
                'id'   => $prefix . 'new_page',
                'type' => 'checkbox',
            ),
            array(
                'name'    => __( 'Page section background', 'cmb2' ),
                'desc'    => __( 'Couleur d\'arrière plan de la section', 'cmb2' ),
                'id'      => $prefix . 'section_bg',
                'type'    => 'colorpicker',
                'default' => '#f4f5f6'
            ),
            array(
                'name'    => __( 'Type', 'cmb2' ),
                'desc'    => __( 'Type de section', 'cmb2' ),
                'id'      => $prefix . 'type',
                'type'    => 'select',
                'options' => array(
                    'standard' => __( 'Standard', 'cmb2' ),
                    'parallax'   => __( 'Parallax', 'cmb2' )
                ),
            ),
            array(
                'name'    => __( 'Scroll Speed', 'cmb2' ),
                'desc'    => __( 'Vitesse de scroll pou l\'effet parallax', 'cmb2' ),
                'id'      => $prefix . 'speed',
                'type'    => 'select',
                'options' => array(
                    '0.1' => __( '0.1', 'cmb2' ),
                    '0.2' => __( '0.2', 'cmb2' ),
                    '0.3' => __( '0.3', 'cmb2' ),
                    '0.4' => __( '0.4', 'cmb2' ),
                    '0.5' => __( '0.5', 'cmb2' ),
                    '0.6' => __( '0.6', 'cmb2' ),
                    '0.7' => __( '0.7', 'cmb2' ),
                    '0.8' => __( '0.8', 'cmb2' ),
                    '0.9' => __( '0.9', 'cmb2' ),
                    '1.0' => __( '1.0', 'cmb2' ),
                    '1.1' => __( '1.1', 'cmb2' ),
                    '1.2' => __( '1.2', 'cmb2' ),
                    '1.3' => __( '1.3', 'cmb2' ),
                    '1.4' => __( '1.4', 'cmb2' ),
                    '1.5' => __( '1.5', 'cmb2' ),
                ),
            ),
            array(
                'name' => __( 'Background URL', 'cmb2' ),
                'desc'    => __( 'Image d\'arrière plan de la section', 'cmb2' ),
                'id'   => $prefix . 'url_bg',
                'type' => 'file',
            ),
            array(
                'name'    => __( 'Affichage Img', 'cmb2' ),
                'desc'    => __( 'Affichage de l\'image', 'cmb2' ),
                'id'      => $prefix . 'fullscreen',
                'type'    => 'select',
                'options' => array(
                    'standard' => __( 'Standard', 'cmb2' ),
                    'fullscreen'   => __( 'Plein écran', 'cmb2' )
                ),
            ),
        ),
    );



    // Add other metaboxes as needed

    return $meta_boxes;
}