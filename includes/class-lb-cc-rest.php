<?php

/**
 * Rest API
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/includes
 */

/**
 * Rest API.
 *
 */
class LB_CC_Rest {
	const namespace = 'lb-cc/v1';
	const preview_compares_route = '/html/preview/compares';
	const compare_table_route = '/html/compares';


	public function init() {
		$namespace = 'lb-cc/v1';

		register_rest_route(static::namespace, static::preview_compares_route, [
			[
				'methods'  => 'GET',
				'callback' =>fn($d) => $this->get_html_preview_compares($d),
				'args'     => $this->get_args(),
			],
			'schema' => fn() => $this->html_casinos_schema(),
		]);
	
		register_rest_route(static::namespace, static::compare_table_route, [
			[
				'methods'  => 'GET',
				'callback' => fn($d) => $this->get_html_compare_table($d),
				'args'     => $this->get_args(),
			],
			'schema' => fn() => $this->html_casinos_schema(),
		]);
	}

	private function get_html_preview_compares(WP_REST_Request $request) {
		$query = $this->build_query($request);
		$items_html = [];
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				ob_start();
				LB_CC_Template_Loader::load()->set_template_data(['id' => get_the_id()])->get_template_part("compare-preview-item");
				$items_html[] = ob_get_contents();
				ob_end_clean();
			}
		}
		wp_reset_postdata();
		return [
			'html' => implode('', $items_html),
			'message' => count($items_html) ? __('Find casinos', 'lb-cc') : __('No compare results', 'lb-cc'),
		];
	}

	private function get_html_compare_table(WP_REST_Request $request) {
		$query = $this->build_query($request);
		$items_html = [];
		if ($query->have_posts()) {
			$item_ind = 1;
			while ($query->have_posts()) {
				$query->the_post();
				ob_start();
				LB_CC_Template_Loader::load()->set_template_data([
					'id' => get_the_id(), 
					'item_ind' => $item_ind])->get_template_part("compare-item");
				$items_html[] = ob_get_contents();
				ob_end_clean();
				$item_ind++;
			}
		}
		wp_reset_postdata();
		return [
			'html' => implode('', $items_html),
			'message' => count($items_html) ? __('Find casinos', 'lb-cc') : __('No compare results', 'lb-cc'),
		];
	}

	private function get_meta(WP_REST_Request $request, $query) {
		return [
			'current_page' => $request->has_param('page') ? $request->get_param('page') : 1,
			'total_pages' => $query->max_num_pages
		];
	}

	private function get_args() {
		$args = [
			'ids' => [
				'type'  => 'array',
				'required' => true,
				'items' => array(
					'type'   => 'integer'
				),
			],
		];

		return $args;
	}

	private function html_casinos_schema() {
		$schema = array(
			'$schema'              => 'http://json-schema.org/draft-04/schema#',
			'title'                => 'casino list in html format',
			'type'                 => 'object',
			'properties'           => array(
				'html' => array(
					'type'                 => 'string',
				),
				'message' => array(
					'type'                 => 'string',
				),
			)
		);
	
	
		return $schema;
	}

	private function html_casino_schema() {
		$schema = array(
			'$schema'              => 'http://json-schema.org/draft-04/schema#',
			'title'                => 'casino',
			'type'                 => 'object',
			'properties'           => array(
				'html' => array(
					'description'  => esc_html__('html card of the casino.'),
					'type'         => 'string',
					'readonly'     => true,
				),
			)
		);

		return $schema;
	}

	private function casinos_meta() {

		$schema = array(
			'type' => 'object',
			'properties'           => array(
				'current_page' => array(
					'type'         => 'integer',
				),
				'total_pages' => array(
					'type'         => 'integer',
				),
			)
		);
		return  $schema;
	}

	private function build_query(WP_REST_Request $request)
	{
		$args = array(
			'post_type' => 'casino',
			'paged' => $request->has_param('page') ? $request->get_param('page') : false,
		);

		if ($request->has_param('ids')) {
			$args['post__in'] = $request->get_param('ids');
		}
		if ($page == '-1') {
			$args['posts_per_page'] = -1;
		}

		if ($request->has_param('s')) {
			$args['s'] = $s;
		}

		return new WP_Query($args);
	}


}
