<?php

class UFCOE_Testable_PluginAnalyzer {

	protected $mod;

	/**
	 * @param string $plugins_path
	 * @throws InvalidArgumentException
	 */
	public function __construct($plugins_path) {
		$plugins_path = rtrim($plugins_path, '/\\');
		if (!is_dir($plugins_path)) {
			throw new InvalidArgumentException('$mod must be a directory');
		}
		$this->mod = $plugins_path;
	}

	/**
	 * @param string $plugin_id
	 * @return UFCOE_Testable_Plugin[]
	 */
	public function getTestablePlugins($plugin_id = null) {
		if ($plugin_id && preg_match('~^[^\\./]+$~', $plugin_id)) {
			$basenames = array($plugin_id);
		} else {
			$basenames = scandir($this->mod);
		}

		$mods = array();
		foreach ($basenames as $basename) {
			$dir = "$this->mod/$basename";
			if ($basename[0] === '.' || !is_dir($dir)) {
				continue;
			}
			$plugin = new UFCOE_Testable_Plugin();
			$plugin->path = $dir;
			if (is_dir("$dir/testable/phpunit")) {
				$plugin->phpunitPath = "$dir/testable/phpunit";
				if (is_file("$dir/testable/phpunit/bootstrap.php")) {
					$plugin->phpunitBootstrap = "$dir/testable/phpunit/bootstrap.php";
				}
			}
			if (is_dir("$dir/testable/simpletest")) {
				$plugin->simpletestPath = "$dir/testable/simpletest";
				if (is_file("$dir/testable/simpletest/bootstrap.php")) {
					$plugin->simpletestBootstrap = "$dir/testable/simpletest/bootstrap.php";
				}
			}
			if ($plugin->simpletestPath || $plugin->phpunitPath) {
				$mods[$basename] = $plugin;
			}
		}

		return $mods;
	}
}
