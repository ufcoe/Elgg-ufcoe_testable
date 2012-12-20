<?php

$analyzer = new UFCOE_Testable_PluginAnalyzer(elgg_get_plugins_path());
$testable_plugins = $analyzer->getTestablePlugins();

echo '<table class="elgg-table"><tr><th>Plugin</th><th>SimpleTest</th><th>PHPUnit</th></tr>';

$site_url = elgg_get_site_url();

foreach ($testable_plugins as $testable_plugin) {
	$plugin_id = basename($testable_plugin->path);
	$plugin = elgg_get_plugin_from_id($plugin_id);
	/* @var ElggPlugin $plugin */
	$plugin_name = htmlspecialchars($plugin->getFriendlyName(), ENT_QUOTES, 'UTF-8');
	$plugin_id = htmlspecialchars($plugin_id, ENT_QUOTES, 'UTF-8');
	echo "<tr><td>$plugin_name</td>";
	echo $testable_plugin->simpletestPath ? "<td><a href=\"{$site_url}testable/run/$plugin_id\">Run tests!</a></td>" : "<td>--</td>";
	echo $testable_plugin->phpunitPath ? "<td>Tests available</td>" : "<td>--</td>";
	echo "</tr>";
}

echo '</table>';

$xml_path = elgg_get_plugins_path() . 'ufcoe_testable/phpunit.xml';
$xml_path = escapeshellarg($xml_path);

?>
<h3 style="margin: 1em 0">Execute PHPUnit Tests</h3>

<p><code>phpunit --colors -vc <?php echo htmlspecialchars($xml_path, ENT_QUOTES, 'UTF-8') ?></code></p>
