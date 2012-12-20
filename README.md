**Note!** This directory must be named `ufcoe_testable` in your mod directory.

## Testable

This plugin simplifies the running of unit tests (both SimpleTest and PHPUnit) for Elgg plugins.

### Setup

Install this plugin as `path/to/Elgg/mod/ufcoe_testable`. E.g. using git:

    cd path/to/Elgg/mod
    git clone git@github.com:ufcoe/Elgg-ufcoe_testable.git ufcoe_testable

 1. Enable the plugin
 1. Visit http://example.org/admin/ufcoe_testable to review available tests, and run individual SimpleTest suites.

The page will also instruct you how to run the PHPUnit tests from your command line (assuming PHPUnit is set up).

### Adding unit tests

Create the directory `testable` at the root of your plugin.

If you have SimpleTest tests (based on Elgg 1.8's core tests), create the directory `simpletest` inside `testable`, and place the tests there. If you create a script `simpletest/bootstrap.php`, it will be executed before your tests run.

If you have PHPUnit tests, create the directory `phpunit` inside `testable`, and place the tests there. If you create a script `phpunit/bootstrap.php`, it will be executed alongside all the other bootstrap scripts before the test suite runs.

#### About the test environments

SimpleTest cases are run after the full Elgg engine boots, like the Elgg 1.8 core test suite (however none of the Elgg core tests are run). Class autoloading relies on Elgg's built-in autoloading framework and whatever your plugin sets up in start.php.

PHPUnit uses the Testable config file to locate test directories matching the glob `mod/*/testable/phpunit`. The Testable bootstrap sets up autoloading for the Elgg core classes and the `classes` folder of all plugins to be tested.

**Note:** The built-in autoloader in Elgg 1.8 is not PSR-0 compliant, however the autoloader used for PHPUnit tests is, so if you use a hierarchy of files in your plugin's `classes` directory, the PHPUnit test suite should operate OK.
