<?php
use PHPMV\js\JavascriptUtils;

include_once dirname(__FILE__) . '/../files/classes/TestClass1.php';
include_once dirname(__FILE__) . '/../files/classes/TestClass2.php';

/**
 * JavascriptUtils test case.
 */
class JavascriptUtilsTest extends \Codeception\Test\Unit {

	protected function assertEqualsIgnoreNewLines($expected, $actual) {
		$this->assertEquals(trim(preg_replace('/\R+/', '', $expected)), trim(preg_replace('/\R+/', '', $actual)));
	}

	/**
	 * Tests JavascriptUtils::objectToJSON()
	 */
	public function testObjectToJSON() {
		$c1 = new TestClass1();
		$c1->id = 11;
		$c1->name = 'Foo';
		$this->assertEquals(json_decode('{"id":11,"name":"Foo"}'), json_decode(JavascriptUtils::toJSON($c1)));

		$c2 = new TestClass2(11, "Bar");
		$this->assertEquals(json_decode('{"id":11,"name":"Bar"}'), json_decode(JavascriptUtils::toJSON($c2)));
	}

	/**
	 * Tests JavascriptUtils::objectToJSON()
	 */
	public function testArrayToJsObject() {
		$c1 = new TestClass1();
		$c1->id = 11;
		$c1->name = 'Foo';
		$this->assertEquals(json_decode('{"id":11,"name":"Foo"}'), json_decode(JavascriptUtils::toJSON($c1)));

		$array = [
			"bool" => true,
			"int" => 1,
			"object" => $c1,
			"string" => '"s"'
		];
		$this->assertEqualsIgnoreNewLines('{bool: true,int: 1,object: {    "id": 11,    "name": "Foo"},string: "s"}', JavascriptUtils::arrayToJsObject($array));
	}

	/**
	 * Tests JavascriptUtils::wrapScript()
	 */
	public function testWrapScript() {
		$s1 = "alert('test');";
		$this->assertEquals("<script>alert('test');</script>", JavascriptUtils::wrapScript($s1));
		$s2 = "<script>alert('test');</script>";
		$this->assertEquals($s2, JavascriptUtils::wrapScript($s2));
		$s3 = '';
		$this->assertEquals($s3, JavascriptUtils::wrapScript($s3));
		$s4 = null;
		$this->assertEquals('', JavascriptUtils::wrapScript($s3));
	}
}

