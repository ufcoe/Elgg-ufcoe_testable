<?php

if (!function_exists('ufcoe_testable_get_autoloader')) {
	function ufcoe_testable_get_autoloader() {
		static $inst;
		if ($inst === null) {
			if (!class_exists('UFCOE_Testable_Loader')) {
				require_once dirname(__FILE__) . '/classes/UFCOE/Testable/Loader.php';
			}
			$inst = new UFCOE_Testable_Loader();
			$inst->addFallback(dirname(__FILE__) . '/classes');
			$inst->register();
		}
		return $inst;
	}
}

return ufcoe_testable_get_autoloader();
