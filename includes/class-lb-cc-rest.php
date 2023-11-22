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
		$posts = $this->build_query_posts($request);

		$items_html .= $this->prepare_item_html($posts);
		$items_html .= $this->prepare_block_item_html($posts);

		return [
			'html' => $items_html,
			'message' => count($posts) ? __('Find casinos', 'lb-cc') : __('No compare results', 'lb-cc'),
		];
	}

	private function prepare_item_html($posts = []) {
		$items_html = '';
		ob_start();
		echo '<div class="lb-cc-table">';
		foreach ($posts as $ind => $post) {
			LB_CC_Template_Loader::load()->set_template_data([
				'id' => $post->ID, 
				'item_ind' => $ind + 1])->get_template_part("compare-item");
		}
		
		echo '</div>';
		$items_html .= ob_get_contents();
		ob_end_clean();
	
		return $items_html;
	}

	private function prepare_block_item_html($posts = []) {
		$items_html = '';
		ob_start();
		echo '<div class="lb-cc-table-scroll">';
		echo '<div class="lb-cc-table">';
		foreach ($posts as $item_ind => $post) {
			$block_item_offset = 1;
			echo '<div class="lb-cc-item" data-id="'. $post->ID .'" style="--lb-cc--item--ind: '. ($item_ind + 1) .'">';
			foreach (LB_CC_Collector::collect_all($post->ID) as $ind => $block) {
				LB_CC_Template_Loader::load()->set_template_data([
					'block' => $block,
					'block_ind' => $ind + 1,
					'block_item_offset' => $block_item_offset])->get_template_part("compare-item-block" );
				$block_item_offset += count($block['list']);
			}
			echo '</div>';
		}

		echo '</div>';
		echo '</div>';
		$items_html .= ob_get_contents();
		ob_end_clean();


		return $items_html;
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
		return new WP_Query($this->build_query_args($request));
	}

	private function build_query_posts(WP_REST_Request $request)
	{
		return (new WP_Query)->query($this->build_query_args($request));
	}

	private function build_query_args(WP_REST_Request $request)
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

		return $args;
	}


}
