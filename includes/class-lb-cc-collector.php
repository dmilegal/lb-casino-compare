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
		array_push($blocks, static::collect_bonuses($id));
		array_push($blocks, static::collect_Software($id));
		
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

	public static function collect_Software(int $id) {
		$bonus_fields = get_field('bonus_fields', $id);
		
		return [
			'title' => __('Software', 'lb-cc'),
			'list' => [
				[
					'title' => __('Test', 'lb-cc'),
					'data' => [
						'value' =>  __('test', 'lb-cc'),
						'contains' => true
					]
				]
			],
			
		];
	}

}
