<?php

/**
 * Collect compare data for casino
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/includes
 */

/**
 * Collect compare data for casino
 *
 *
 */
class LB_CC_Collector {

	public static function collect_all(int $id) {
		$blocks = [];
		$settings = get_field('lb_cc_list_of_blocks', 'option');

		if (!$settings) return $blocks;

		foreach ($settings as $setting) {
			if ($setting['block'] == 'bonuses')
			array_push($blocks,static::collect_bonuses($id));
			else {
				$tax = get_taxonomy($setting['block']);
				$data = static::collect_tax($id, $setting['block'], __($tax->label, 'lb-cc'));
				if (count($data['list']))
					array_push($blocks, $data);
			}
			
		}

		return $blocks;
	}

	public static function collect_bonuses(int $id) {
		$bonus_fields = get_field('bonus_fields', $id) ? get_field('bonus_fields', $id) : [];
		
		return [
			'title' => __('Bonuses', 'lb-cc'),
			'list' => [
				[
					'title' => __('For whom', 'lb-cc'),
					'data' => [
						'value' => isset($bonus_fields['for_whom']) ? __($bonus_fields['for_whom'], 'lb-cc') : '-'
					]
				],
				[
					'title' => __('Form', 'lb-cc'),
					'data' => [
						'value' => isset($bonus_fields['form']) ? __($bonus_fields['form'], 'lb-cc') : '-'
					]
				],
				[
					'title' => __('Type', 'lb-cc'),
					'data' => [
						'value' => isset($bonus_fields['type']) ? __($bonus_fields['type'], 'lb-cc') : '-'
					]
				],
				[
					'title' => __('Term', 'lb-cc'),
					'data' => [
						'value' =>   isset($bonus_fields['term']) ? __($bonus_fields['term'], 'lb-cc') : '-'
					]
				],
				[
					'title' => __('Best bonus', 'lb-cc'),
					'data' => [
						'value' =>  isset($bonus_fields['best_bonus']) ? __($bonus_fields['best_bonus'], 'lb-cc') : '-'
					]
				],
				[
					'title' => __('Cashback', 'lb-cc'),
					'data' => [
						'value' =>  isset($bonus_fields['cashback']) ? __($bonus_fields['cashback'], 'lb-cc') : '-'
					]
				],
				[
					'title' => __('Birthday bonus', 'lb-cc'),
					'data' => [
						'value' =>  isset($bonus_fields['birthday_bonus']) ? __($bonus_fields['birthday_bonus'], 'lb-cc') : '-'
					]
				]
			],
			
		];
	}

	private static function collect_tax(int $id, string $tax, string $title) {
		$cur_terms = get_the_terms( $id, $tax );
		$cur_term_ids = wp_list_pluck( $cur_terms, 'term_id' );
		$terms = get_terms( $tax, [
			'hide_empty' => false,
		]);

		return [
			'title' => $title,
			'list' => array_map(fn($term) => [
					'data' => [
						'value' =>  __($term->name, 'lb-cc'),
						'contains' => in_array($term->term_id, $cur_term_ids)
					]
				]
			, $terms)
		];

	}

}
