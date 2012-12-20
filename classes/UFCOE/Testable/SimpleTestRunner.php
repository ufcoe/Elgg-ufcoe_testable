<?php

class UFCOE_Testable_SimpleTestRunner {

	public function runSuite($name, $files) {
		admin_gatekeeper();

		global $CONFIG;
		$vendor_path = "$CONFIG->path/vendors/simpletest";
		$test_path = "$CONFIG->path/engine/tests";

		require_once "$vendor_path/unit_tester.php";
		require_once "$vendor_path/mock_objects.php";
		require_once "$vendor_path/reporter.php";
		require_once "$test_path/ElggCoreUnitTest.php";

		// turn off system log
		elgg_unregister_event_handler('all', 'all', 'system_log_listener');
		elgg_unregister_event_handler('log', 'systemlog', 'system_log_default_logger');

		// Disable maximum execution time.
		// Tests take a while...
		set_time_limit(0);

		$suite = new TestSuite($name);
		foreach ($files as $file) {
			$suite->addFile($file);
		}

		if (TextReporter::inCli()) {
			// In CLI error codes are returned: 0 is success
			elgg_set_ignore_access(TRUE);
			exit ($suite->Run(new TextReporter()) ? 0 : 1 );
		}

		$footer = '<p><a href="../../admin/ufcoe_testable">&larr; Back</a></p>';

		$old = elgg_set_ignore_access(TRUE);
		$suite->Run(new UFCOE_Testable_SimpleReporter($footer));
		elgg_set_ignore_access($old);

		// Without an explicit exit call, we sometimes get the 404 page
		exit;
	}
}
