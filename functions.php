<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $deps = array('twenty-twenty-one-style','twenty-twenty-one-print-style');
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', $deps );
}

/**
* add fields to the customizer 
*/
function sds_child_theme_customize_register( $wp_customize ) {
    //All our sections, settings, and controls will be added here
    $wp_customize->add_section( 'sds_child_theme_customizations' , array(
        'title'      => __( 'Theme Settings', 'sds_2015_child' ),
        'priority'   => 999,
    ) );
    $wp_customize->add_setting( 'masthead_background_color' , array(
        'default'   => '#000000',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_setting( 'copyright' , array(
        'default'   => '',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'masthead_background_color', array(
        'label'      => __( 'Masthead Background', 'sds_child' ),
        'section'    => 'sds_child_theme_customizations',
        'settings'   => 'masthead_background_color',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright', array(
        'label'      => __( 'Copyright', 'sds_child' ),
        'section'    => 'sds_child_theme_customizations',
        'settings'   => 'copyright',
        'type'       => 'text',
    ) ) );
    }
add_action( 'customize_register', 'sds_child_theme_customize_register' );

/**
 * Generate CSS from the options
 */
function sds_child_theme_customize_css()
{
    ?>
         <style type="text/css">
             .wp-custom-logo .site-header { background: <?php echo get_theme_mod('masthead_background_color', '#000000'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'sds_child_theme_customize_css');