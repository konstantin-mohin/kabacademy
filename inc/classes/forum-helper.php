<?php

class KabacedemyForumHelper {
	private static $_instance = null;

	static public function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function init() {
//		add_action( 'carbon_fields_register_fields', [ $this, 'add_page_fields' ] );
	}

	public function getPinnedTopics( $forum_id ) {

		$posts_ids = bbp_get_stickies( $forum_id );

		if ( ! empty( $posts_ids ) ) {
			$args = [
				'post_type' => 'topic',
				'post__in'  => $posts_ids
			];

			return new WP_Query( $args );
		}

		return false;
	}
}