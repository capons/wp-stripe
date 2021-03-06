<?php

if (!defined('WPO_VERSION')) die('No direct access allowed');

// TODO: Does this need renaming? It is not just auto-drafts, but also trashed posts

class WP_Optimization_autodraft extends WP_Optimization {

	public $available_for_auto = true;
	public $auto_default = true;
	public $setting_default = true;
	public $available_for_saving = true;
	public $ui_sort_order = 3000;

	protected $setting_id = 'drafts';
	protected $auto_id = 'drafts';

	public function optimize() {
	
		$clean = "DELETE FROM `".$this->wpdb->posts."` WHERE post_status = 'auto-draft'";
				
		if ($this->retention_enabled == 'true') {
			$clean .= ' AND post_modified < NOW() - INTERVAL ' .  $this->retention_period . ' WEEK';
		}

		$clean .= ';';

		$autodraft = $this->query($clean);

		$this->register_output(sprintf(_n('%d auto draft deleted', '%d auto drafts deleted', $autodraft, 'wp-optimize'), number_format_i18n($autodraft)));

		// TODO:  query trashed posts and cleanup metadata
		$clean = "DELETE FROM `".$this->wpdb->posts."` WHERE post_status = 'trash'";

		if ($this->retention_enabled == 'true') {
			$clean .= ' AND post_modified < NOW() - INTERVAL ' .  $this->retention_period . ' WEEK';
		}

		$clean .= ';';

		$posttrash = $this->query($clean);

		$this->register_output(sprintf(_n('%d item removed from Trash', '%d items removed from Trash', $posttrash, 'wp-optimize'), number_format_i18n($posttrash)));
	}
	
	public function get_info() {
		
		$sql = "SELECT COUNT(*) FROM `".$this->wpdb->posts."` WHERE post_status = 'auto-draft'";

		if ($this->retention_enabled == 'true') {
			$sql .= ' and post_modified < NOW() - INTERVAL ' .  $this->retention_period . ' WEEK';
		}

		$sql .= ';';

		$autodraft = $this->wpdb->get_var($sql);

		if(!$autodraft == 0 || !$autodraft == NULL){
			$message = sprintf(_n('%d auto draft post in your database', '%d auto draft posts in your database', $autodraft, 'wp-optimize'), number_format_i18n($autodraft));
		} else {
			$message =__('No auto draft posts found', 'wp-optimize');
		}
		
		$this->register_output($message);
	}
	
	public function settings_label() {
	
		if ($this->retention_enabled == 'true') {
			return sprintf(__('Clean auto draft posts which are older than %d weeks', 'wp-optimize'), $this->retention_period);
		} else {
			return __('Clean all auto draft posts and posts in trash', 'wp-optimize');
		}
	
	}

	public function get_auto_option_description() {
		return __('Remove auto drafts', 'wp-optimize');
	}

}
