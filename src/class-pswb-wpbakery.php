<?php

class PSWB_WP_Bakery extends WPBakeryShortCode {

	/**
	 * Constructor for PS_Visual_Composer
	 */
	public function __construct() {
		add_action( 'vc_after_init', array( $this, 'wpwb_passster_row' ) );
	}
	/**
	 * Add parameters after vc init for vc_row element.
	 *
	 * @return void
	 */
	public function wpwb_passster_row() {

		if ( ps_fs()->is_plan__premium_only( 'pro' ) ) {

			$args            = array( 'post_type' => 'password_lists', 'posts_per_page' => -1 );
			$lists           = get_posts( $args );
			$choosable_lists = array();
			$choosable_lists[''] = '';

			if ( isset( $lists ) && ! empty( $lists ) ) {
				foreach ( $lists as $list ) {
					$choosable_lists[] = array( 'value' => $list->ID, 'label' => $list->post_title );
				}
			}

			$protection_mode = array(
				'type'        => 'dropdown',
				'heading'     => __( 'Protection type', 'content-protector' ),
				'param_name'  => 'passster_protection_type',
				'value'       => array(
					array(
						'value' => 'password',
						'label' => __( 'Password', 'content-protector' ),
					),
					array(
						'value' => 'captcha',
						'label' => __( 'Captcha', 'content-protector' ),
					),
					array(
						'value' => 'recaptcha',
						'label' => __( 'ReCatpcha', 'content-protector' ),
					),
					array(
						'value' => 'passwords',
						'label' => __( 'Passwords', 'content-protector' ),
					),
					array(
						'value' => 'password_list',
						'label' => __( 'Password List', 'content-protector' ),
					),
				),
				'description' => __( 'Choose your protection type', 'content-protector' ),
				'admin_label' => false,
				'dependency'  => '',
				'weight'      => 0,
				'group'       => 'Protection',
				);

				$passwords = array(
					'type'        => 'textfield',
					'heading'     => __( 'Passwords', 'content-protector' ),
					'param_name'  => 'passster_passwords',
					'description' => __( 'Add multiple passwords separated by comma.', 'content-protector' ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				);

				$password_list = array(
					'type'        => 'dropdown',
					'heading'     => __( 'Password List', 'content-protector' ),
					'param_name'  => 'passster_password_list',
					'value'       => $choosable_lists,
					'description' => __( 'Choose your password list', 'content-protector' ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				);

			$vc_row_new_params = array(
				array(
					'type'        => 'checkbox',
					'heading'     => __( 'Activate Protection', 'content-protector' ),
					'param_name'  => 'passster_protection_activation',
					'value'       => false,
					'description' => __( 'Activate protection?', 'content-protector' ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				$protection_mode,
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Authentication', 'content-protector' ),
					'param_name'  => 'passster_authentication',
					'description' => __( 'Use this if you have multiple Passster elements per page', 'content-protector' ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Password', 'content-protector' ),
					'param_name'  => 'passster_password',
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'API', 'content-protector' ),
					'param_name'  => 'passster_api',
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				$passwords,
				$password_list,
				array(
					'type'        => 'textarea_html',
					'heading'     => __( 'Protected Text', 'content-protector' ),
					'param_name'  => 'passster_protected_text',
					'value'       => __( 'This is your protected content!', 'content-protector' ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Headline', 'content-protector' ),
					'param_name'  => 'passster_headline',
					'value'       => get_theme_mod( 'passster_form_instructions_headline', __( 'Protected Area', 'content-protector' ) ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				array(
					'type'        => 'textarea',
					'heading'     => __( 'Instruction Text', 'content-protector' ),
					'param_name'  => 'passster_instruction',
					'value'       => get_theme_mod( 'passster_form_instructions_text', __( 'This content is password-protected. Please verify with a password to unlock the content.', 'content-protector' ) ),
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Placeholder Text', 'content-protector' ),
					'value'       => get_theme_mod( 'passster_form_instructions_placeholder', __( 'Enter your password..', 'content-protector' ) ),
					'param_name'  => 'passster_placeholder',
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Button Label', 'content-protector' ),
					'value'       => get_theme_mod( 'passster_form_button_label', __( 'Submit', 'content-protector' ) ),
					'param_name'  => 'passster_button_label',
					'admin_label' => false,
					'dependency'  => '',
					'weight'      => 0,
					'group'       => 'Protection',
				),
			);
			vc_add_params( 'vc_row', $vc_row_new_params );
		}
	}
}

new PSWB_WP_Bakery();
