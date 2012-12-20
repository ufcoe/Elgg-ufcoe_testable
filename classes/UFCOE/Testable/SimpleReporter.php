<?php

class UFCOE_Testable_SimpleReporter extends HtmlReporter {

	protected $_footerHtml;

	public function __construct($footer = '') {
		$this->HtmlReporter('UTF-8');
		$this->_footerHtml = $footer;
	}

	/**
	 *    Paints the end of the test with a summary of
	 *    the passes and failures.
	 *    @param string $test_name        Name class of test.
	 *    @access public
	 */
	function paintFooter($test_name) {
		$colour = ($this->getFailCount() + $this->getExceptionCount() > 0 ? "red" : "green");
		print "<div style=\"";
		print "padding: 8px; margin-top: 1em; background-color: $colour; color: white;";
		print "\">";
		print $this->getTestCaseProgress() . "/" . $this->getTestCaseCount();
		print " test cases complete:\n";
		print "<strong>" . $this->getPassCount() . "</strong> passes, ";
		print "<strong>" . $this->getFailCount() . "</strong> fails and ";
		print "<strong>" . $this->getExceptionCount() . "</strong> exceptions.";
		print "</div>\n";

		echo $this->_footerHtml;

		print "</body>\n</html>\n";
	}
}
