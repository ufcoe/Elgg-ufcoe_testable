<?php

$loader = (require dirname(__FILE__) . '/get-autoloader.php');
/* @var UFCOE_Testable_Loader $loader */

$pa = new UFCOE_Testable_PluginAnalyzer(dirname(dirname(__FILE__)));
$plugs = $pa->getTestablePlugins();

foreach ($plugs as $plug) {
	if ($plug->phpunitPath) {
		$loader->addFallback($plug->path . '/classes');
	}
}

foreach ($plugs as $plug) {
	if ($plug->phpunitBootstrap) {
		require $plug->phpunitBootstrap;
	}
}
