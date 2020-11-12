<?php
namespace PHPMV\core;

/**
 * A template parser for js files.
 *
 * PHPMV\core$TemplateParser
 * This class is part of php-ui-common
 *
 * @author jc
 * @version 1.0.0
 *
 */
class TemplateParser {

	/**
	 * The template content.
	 *
	 * @var string
	 */
	private $templateContent;

	/**
	 * The default template file extension.
	 *
	 * @var string
	 */
	private const FILE_EXT = '.tpl.js';

	/**
	 *
	 * @var string
	 */
	private const OPEN_TAG = '/*';

	/**
	 *
	 * @var string
	 */
	private const CLOSE_TAG = '*/';

	/**
	 * The active template directory
	 *
	 * @var string
	 */
	private static $templateDirectory;

	/**
	 * Load a template file.
	 *
	 * @param string $filename
	 */
	public function loadTemplatefile(string $filename): void {
		$completeFilename = self::$templateDirectory . $filename . self::FILE_EXT;
		$this->templateContent = \file_get_contents($completeFilename);
	}

	/**
	 * Parse a loaded template file with values (in an associative array).
	 * Variables in template are defined with the OPEN_TAG, a key of the array and the CLOSE_TAG.
	 *
	 * @param array $values
	 * @return string
	 */
	public function parse(array $values): string {
		$result = $this->templateContent;
		foreach ($values as $k => $v) {
			$result = \str_replace(self::OPEN_TAG . $k . self::CLOSE_TAG, $v);
		}
		return $result;
	}

	/**
	 * Load and parse a template file with values (in an associative array).
	 *
	 * @param string $filename
	 * @param array $values
	 * @return string
	 */
	public function loadAndParse(string $filename, array $values): string {
		$this->loadTemplatefile($filename);
		return $this->parse($values);
	}

	/**
	 * Return the active template directory.
	 *
	 * @return string
	 */
	public static function getTemplateDirectory(): string {
		return self::$templateDirectory;
	}

	/**
	 * Define the template base directory.
	 *
	 * @param string $templateDirectory
	 */
	public static function setTemplateDirectory(string $templateDirectory): void {
		self::$templateDirectory = $templateDirectory;
	}
}

