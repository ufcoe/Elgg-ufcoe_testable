<?php

class UFCOE_Testable {

	static public function handlePage($segments) {
		$testable = self::getInstance();

		$segments = array_pad($segments, 2, null);
		if ($segments[0] === 'run' && !empty($segments[1])) {
			$testable->pageTestSuite($segments[1]);
		}

		return $testable->pageListing();

		return false;
	}

	/**
	 * @return UFCOE_Testable
	 */
	static public function getInstance() {
		static $inst;
		if ($inst === null) {
			$inst = new self();
		}
		return $inst;
	}

	public function pageTestSuite($plugin_id) {

		admin_gatekeeper();

		if (!$plugin_id || !($plugin = elgg_get_plugin_from_id($plugin_id))) {
			register_error("Plugin not given or inactive");
			forward('admin/ufcoe_testable');
		}
		/* @var ElggPlugin $plugin */

		$analyzer = new UFCOE_Testable_PluginAnalyzer(elgg_get_plugins_path());
		$testable_plugins = $analyzer->getTestablePlugins($plugin_id);

		if (empty($testable_plugins[$plugin_id])) {
			register_error("Plugin '$plugin_id' has no tests");
			forward('admin/ufcoe_testable');
		}

		$testable_plugin = $testable_plugins[$plugin_id];

		$test_files = $testable_plugin->getSimpletestFiles();
		if (!$test_files) {
			register_error("Plugin '$plugin_id' has no files runnable by SimpleTest");
			forward('admin/ufcoe_testable');
		}

		$test_files = elgg_trigger_plugin_hook('ufcoe_testable:test', $plugin_id, null, $test_files);

		$runner = new UFCOE_Testable_SimpleTestRunner();
		$suite_name = "Tests for: " . $plugin->getFriendlyName();

		if ($testable_plugin->simpletestBootstrap) {
			require $testable_plugin->simpletestBootstrap;
		}

		$runner->runSuite($suite_name, $test_files);

		exit;
	}
}
