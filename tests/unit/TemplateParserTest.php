<?php
use PHPMV\core\TemplateParser;

/**
 * TemplateParser test case.
 */
class TemplateParserTest extends \Codeception\Test\Unit {

	/**
	 *
	 * @var TemplateParser
	 */
	private $templateParser;

	protected function _before() {
		TemplateParser::setTemplateDirectory(dirname(__FILE__) . '/../files/templates/');
		$this->templateParser = new TemplateParser();
	}

	protected function _after() {
		$this->templateParser = null;
	}

	/**
	 * Tests TemplateParser->loadTemplatefile()
	 */
	public function testLoadTemplatefile() {
		$this->templateParser->loadTemplatefile('renderComponent');
		$this->assertStringContainsString('domContainer', $this->templateParser->getTemplateContent());
	}

	/**
	 * Tests TemplateParser->parse()
	 */
	public function testParse() {
		$this->templateParser->loadTemplatefile('renderComponent');

		$res = $this->templateParser->parse([
			'selector' => 'id',
			'component' => 'myCompo'
		]);
		$this->assertEquals("const domContainer = document.querySelector('id');
ReactDOM.render(e(myCompo), domContainer);", $res);
	}

	/**
	 * Tests TemplateParser->loadAndParse()
	 */
	public function testLoadAndParse() {
		$res = $this->templateParser->loadAndParse('renderComponent', [
			'selector' => 'id',
			'component' => 'myCompo'
		]);
		$this->assertEquals("const domContainer = document.querySelector('id');
ReactDOM.render(e(myCompo), domContainer);", $res);
	}

	/**
	 * Tests TemplateParser::getTemplateDirectory()
	 */
	public function testGetTemplateDirectory() {
		$this->assertEquals(dirname(__FILE__) . '/../files/templates/', TemplateParser::getTemplateDirectory());
	}
}

