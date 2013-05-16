<?php
// $Id: validator_tests.php,v 1.1 2008/07/07 18:00:40 mrflos Exp $

require_once('simple_include.php');
require_once('calendar_include.php');

class ValidatorTests extends GroupTest {
    function ValidatorTests() {
        $this->GroupTest('Validator Tests');
        $this->addTestFile('validator_unit_test.php');
        $this->addTestFile('validator_error_test.php');
    }
}

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = &new ValidatorTests();
    $test->run(new HtmlReporter());
}
?>