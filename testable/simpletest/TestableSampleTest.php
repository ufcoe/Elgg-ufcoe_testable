<?php

class TestableSampleTest extends ElggCoreUnitTest {

	public function testSample() {
		$this->assertTrue(in_array(dirname(__FILE__) . '/bootstrap.php', get_included_files()));
	}
}
