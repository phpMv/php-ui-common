<?php
use PHPMV\js\JsUtils;

include_once dirname(__FILE__) . '/../files/classes/TestClass1.php';
include_once dirname(__FILE__) . '/../files/classes/TestClass2.php';

/**
 * JsUtils test case.
 */
class JsUtilsTest extends \Codeception\Test\Unit {

	/**
	 * Tests JsUtils::objectToJSON()
	 */
	public function testObjectToJSON() {
		$c1 = new TestClass1();
		$c1->id = 11;
		$c1->name = 'Foo';
		$this->assertEquals(json_decode('{"id":11,"name":"Foo"}'), json_decode(JsUtils::objectToJSON($c1)));

		$c2 = new TestClass2(11, "Bar");
		$this->assertEquals(json_decode('{"id":11,"name":"Bar"}'), json_decode(JsUtils::objectToJSON($c2)));
	}

	/**
	 * Tests JsUtils::wrapScript()
	 */
	public function testWrapScript() {
		$s1 = "alert('test');";
		$this->assertEquals("<script>alert('test');</script>", JsUtils::wrapScript($s1));
		$s2 = "<script>alert('test');</script>";
		$this->assertEquals($s2, JsUtils::wrapScript($s2));
	}
}

