<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$deps = array( 'twenty-twenty-one-style', 'twenty-twenty-one-print-style' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', $deps );
}

/**
* add fields to the customizer
*/
function sds_2021_child_theme_customize_register( $wp_customize ) {
	//All our sections, settings, and controls will be added here
	$wp_customize->add_section(
		'sds_2021_child_theme_customizations',
		array(
			'title'    => __( 'Theme Settings', 'sds_2021_child' ),
			'priority' => 999,
		)
	);
	$wp_customize->add_setting(
		'masthead_background_color',
		array(
			'default'   => '#000000',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_setting(
		'copyright',
		array(
			'default'   => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'masthead_background_color',
			array(
				'label'             => __( 'Masthead Background', 'sds_2021_child' ),
				'section'           => 'sds_2021_child_theme_customizations',
				'settings'          => 'masthead_background_color',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'copyright',
			array(
				'label'    => __( 'Copyright', 'sds_2021_child' ),
				'section'  => 'sds_2021_child_theme_customizations',
				'settings' => 'copyright',
				'type'     => 'text',
			)
		)
	);
	$wp_customize->add_setting(
		'hide_powered_by',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sds_2021_child_sanitize_checkbox',
		)
	);
	$wp_customize->add_setting(
		'masthead_border',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sds_2021_child_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'hide_powered_by',
		array(
			'type'        => 'checkbox',
			'section'     => 'sds_2021_child_theme_customizations', // Add a default or your own section
			'label'       => __( 'Hide Powered By WordPress' ),
			'description' => __( 'Check to hide Powered By in the footer.' ),
		)
	);

	$wp_customize->add_control(
		'masthead_border',
		array(
			'type'        => 'checkbox',
			'section'     => 'sds_2021_child_theme_customizations', // Add a default or your own section
			'label'       => __( 'Border below masthead?', 'sds_2021_child' ),
			'description' => __( 'Add a border below the masthead.', 'sds_2021_child' ),
		)
	);

	$wp_customize->add_setting(
		'masthead_border_color',
		array(
			'default'   => '#000000',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'masthead_border_color',
			array(
				'label'             => __( 'Masthead border color', 'sds_2021_child' ),
				'section'           => 'sds_2021_child_theme_customizations',
				'settings'          => 'masthead_border_color',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		)
	);
}
add_action( 'customize_register', 'sds_2021_child_theme_customize_register' );

function sds_2021_child_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
/**
 * Generate CSS from the options
 */
function sds_2021_child_theme_customize_css() {  ?>
		 <style type="text/css">
			 .wp-custom-logo .site-header { 
				 background: <?php echo  get_theme_mod( 'masthead_background_color', '#000000' ); ?>; 
	<?php
	if ( get_theme_mod( 'masthead_border', false ) ) {
		echo 'border-bottom: 1px solid ' . get_theme_mod( 'masthead_border_color', '#000000' ) . ';';
	}
	echo '} </style>';
}
add_action( 'wp_head', 'sds_2021_child_theme_customize_css' );