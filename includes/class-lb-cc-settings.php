<?php

/**
 * Init settings
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/includes
 */

/**
 * Init settings
 *
 */
class LB_CC_Settings {

	
	public function init() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}
	
		acf_add_local_field_group( array(
		'key' => 'group_65044c287526f',
		'title' => 'Settings',
		'fields' => array(
			array(
				'key' => 'field_65044c2973bd9',
				'label' => 'Styles',
				'name' => '',
				'aria-label' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_65044c5673bda',
				'label' => 'Positions of the bar open button',
				'name' => 'lb_cc_open_bar_button_positions',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_65044d4773bdb',
						'label' => 'Position',
						'name' => 'position',
						'aria-label' => '',
						'type' => 'button_group',
						'instructions' => 'Button position on the screen',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '33',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'bottom-left' => 'bottom-left',
							'bottom-right' => 'bottom-right',
						),
						'default_value' => 'bottom-right',
						'return_format' => 'value',
						'allow_null' => 0,
						'layout' => 'horizontal',
					),
					array(
						'key' => 'field_65044e0a73bdc',
						'label' => 'X Offset',
						'name' => 'x_offset',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => 'button offset from the right or left edge',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '33',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => 0,
						'max' => 100,
						'placeholder' => '',
						'step' => 1,
						'prepend' => '',
						'append' => 'px',
					),
					array(
						'key' => 'field_65044ec273bdd',
						'label' => 'Y Offset',
						'name' => 'y_offset',
						'aria-label' => '',
						'type' => 'number',
						'instructions' => 'button offset from the top or bottom',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '33',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'min' => 0,
						'max' => 100,
						'placeholder' => '',
						'step' => 1,
						'prepend' => '',
						'append' => 'px',
					),
				),
			),
			array(
				'key' => 'field_6504608cd8863',
				'label' => 'Comparison settings',
				'name' => '',
				'aria-label' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'top',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_650598a5f964c',
				'label' => 'Maximum number of elements for comparison',
				'name' => 'lb_cc_max_count',
				'aria-label' => '',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'min' => 2,
				'max' => 12,
				'placeholder' => '',
				'step' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_650460d2d8864',
				'label' => 'List of blocks for comparison',
				'name' => 'lb_cc_list_of_blocks',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_650464b34e0a5',
						'label' => 'Block',
						'name' => 'block',
						'aria-label' => '',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array_merge(array(
							'bonuses' => 'Bonuses',
						), $this->get_taxs_options()),
						'default_value' => false,
						'return_format' => 'value',
						'multiple' => 0,
						'allow_null' => 0,
						'ui' => 0,
						'ajax' => 0,
						'placeholder' => '',
						'parent_repeater' => 'field_650460d2d8864',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'lb-cc-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
		));
	}

	private function get_taxs_options() {
		$taxs = get_taxonomies( [
			'object_type' => ['casino']
		], 'objects');

		return array_reduce($taxs, function($car, $tax) {
			$car[$tax->name] = $tax->label;
			return $car;
		}, []);
	}

}
