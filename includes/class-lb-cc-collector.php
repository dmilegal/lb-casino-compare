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
		$methods = ['collect_bonuses', 'collect_software', 'collect_deposit_methods', 'collect_withdrawal_methods',
		'collect_withdrawal_limits', 'collect_restricted_countries', 'collect_licences', 'collect_languages',
		'collect_currencies', 'collect_devices'];

		foreach ($methods as $method) {
			$data = static::{$method}($id);
			if (count($data['list']))
				array_push($blocks, $data);
		}

		return $blocks;
	}

	public static function collect_bonuses(int $id) {
		$bonus_fields = get_field('bonus_fields', $id);
		
		return [
			'title' => __('Bonuses', 'lb-cc'),
			'list' => [
				[
					'title' => __('For whom', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['for_whom'], 'lb-cc')
					]
				],
				[
					'title' => __('Form', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['form'], 'lb-cc')
					]
				],
				[
					'title' => __('Type', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['type'], 'lb-cc')
					]
				],
				[
					'title' => __('Term', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['term'], 'lb-cc')
					]
				],
				[
					'title' => __('Best bonus', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['best_bonus'], 'lb-cc')
					]
				],
				[
					'title' => __('Cashback', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['cashback'], 'lb-cc')
					]
				],
				[
					'title' => __('Birthday bonus', 'lb-cc'),
					'data' => [
						'value' =>  __($bonus_fields['birthday_bonus'], 'lb-cc')
					]
				]
			],
			
		];
	}

	public static function collect_software(int $id) {
		return static::collect_tax($id, 'software', __('Software', 'lb-cc'));
	}

	public static function collect_deposit_methods(int $id) {
		return static::collect_tax($id, 'deposit-method', __('Deposit Methods', 'lb-cc'));
	}

	public static function collect_withdrawal_methods(int $id) {
		return static::collect_tax($id, 'withdrawal-method', __('Withdrawal Methods', 'lb-cc'));
	}

	public static function collect_withdrawal_limits(int $id) {
		return static::collect_tax($id, 'withdrawal-limit', __('Withdrawal Limits', 'lb-cc'));
	}

	public static function collect_restricted_countries(int $id) {
		return static::collect_tax($id, 'restricted-country', __('Restricted Countries', 'lb-cc'));
	}

	public static function collect_licences(int $id) {
		return static::collect_tax($id, 'licence', __('Licences', 'lb-cc'));
	}

	public static function collect_languages(int $id) {
		return static::collect_tax($id, 'language', __('Languages', 'lb-cc'));
	}

	public static function collect_currencies(int $id) {
		return static::collect_tax($id, 'currency', __('Currencies', 'lb-cc'));
	}

	public static function collect_devices(int $id) {
		return static::collect_tax($id, 'device', __('Devices', 'lb-cc'));
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
