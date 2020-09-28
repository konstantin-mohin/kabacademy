<?php

/**
 * Get instance of helper
 *
 * @return KabacedemyThemeHelper
 */
function kab_help() {
	return KabacedemyThemeHelper::getInstance();
}

class KabacedemyThemeHelper {

	public $forum;
	public $helper;
	public $settings;
	public $statistics;

	private static $_instance = null;

	private function __construct() {
	}

	protected function __clone() {
	}

	static public function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function init() {

		$this->import();

		$this->load_classes();

		$this->settings->init();

		$this->forum->init();

		if ( class_exists( 'OnePixStatistics' ) ) {
			$this->statistics->init();
		}

		return $this;
	}

	private function load_classes() {
		$this->forum    = KabacedemyForumHelper::getInstance();
		$this->helper   = KabacedemyHelper::getInstance();
		$this->settings = KabacedemyThemeSettings::getInstance();

		if ( class_exists( 'OnePixStatistics' ) ) {
			$this->statistics = OnePixStatistics::getInstance();
		}
	}


	private function import() {
		require_once 'classes/theme-settings.php';
		require_once 'classes/forum-helper.php';
		require_once 'classes/helper.php';
	}
}
