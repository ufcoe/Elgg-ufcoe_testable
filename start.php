<?php

if (preg_match('~(/testable/run/|/admin/ufcoe_testable)~', $_SERVER['REQUEST_URI'])) {

	require_once dirname(__FILE__) . '/get-autoloader.php';

	elgg_register_page_handler('testable', 'UFCOE_Testable::handlePage');
}

if (false !== strpos($_SERVER['REQUEST_URI'], '/admin')) {

	function ufcoe_testable_setup_admin_menu() {
		elgg_register_menu_item('page', array(
			'name' => 'ufcoe_testable',
			'href' => 'admin/ufcoe_testable',
			'text' => elgg_echo("admin:ufcoe_testable"),
			'context' => 'admin',
			'section' => 'develop',
		));
	}

	elgg_register_event_handler('pagesetup', 'system', 'ufcoe_testable_setup_admin_menu');
}
