<?php

/**
 * Compare state
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/includes
 */

/**
 * The class is responsible for the current state of the comparison. Contains information 
 * about the current posts in the comparison.
 */
class LB_CC_State {
	const COMPARE_COOKIE_NAME = 'lb-cc-compare-ids';

	/**
	 * Init shortcodes.
	 */
	public static function get_compare_ids() {
		return isset($_COOKIE[LB_CC_State::COMPARE_COOKIE_NAME]) ? explode(',', $_COOKIE[LB_CC_State::COMPARE_COOKIE_NAME]) : [];
	}
}
