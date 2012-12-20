<?php

class TestableSampleTest extends PHPUnit_Framework_TestCase {

	public function testSample() {
		$this->assertTrue(in_array(dirname(__FILE__) . '/bootstrap.php', get_included_files()));
	}

}
