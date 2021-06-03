<?php

namespace PHPMV\js;

/**
 * Javascript utilities.
 * PHPMV\js$JavascriptUtils
 * This class is part of php-ui-common
 *
 * @author jc
 * @version 1.0.0
 *
 */
class JavascriptUtils {

	static private array $removeQuote = ["start" => "!!%", "end" => "%!!"];

	/**
	 * Returns a JSON string from an object.
	 *
	 * @param mixed $object
	 * @return string
	 */
	public static function toJSON($object): string {
		if (\is_object($object)) {
			if (\method_exists($object, 'toArray')) {
				$object = $object->toArray();
			} else {
				$object = (array) $object;
			}
		}
		return \json_encode($object, \JSON_PRETTY_PRINT | \JSON_NUMERIC_CHECK);
	}

	/**
	 * Return a javascript object from a php associative array.
	 *
	 * @param array $array
	 * @return string
	 */
	public static function arrayToJsObject(array $array): string {
		$res = [];
		foreach ($array as $k => $v) {
			if (\is_object($v) || \is_array($v)) {
				$v = self::toJSON($v);
			} elseif (\is_bool($v)) {
				$v = ($v) ? 'true' : 'false';
			} elseif (\is_string($v)) {
				$v = '"' . $v . '"';
			}
			$res[] = "$k: $v";
		}
		return '{' . \implode(',', $res) . '}';
	}

	/**
	 * Add script tags to a javascript code.
	 *
	 * @param string $script
	 * @return string
	 */
	public static function wrapScript(string $script): string {
		if ($script == null) {
			return '';
		}
		if (\substr($script, 0, \strlen('<script>')) !== '<script>') {
			$script = "<script>$script</script>";
		}
		return $script;
	}

	public static function cleanJSONFunctions(string $json): string {
		$pattern = '/(("|\')' . self::$removeQuote['start'] . ')|(' . self::$removeQuote['end'] . '("|\'))/';
		return \preg_replace($pattern, '', $json);
	}

	public static function removeQuotes(string $body): string {
		return self::$removeQuote["start"] . $body . self::$removeQuote["end"];
	}

	public static function generateFunction(string $body, array $params = [], bool $needRemoveQuote = true): string {
		if ($needRemoveQuote) {
			return self::removeQuotes("function(" . \implode(",", $params) . "){ $body }");
		}
		return "function(" . \implode(",", $params) . "){ $body }";
	}

	public static function declareVariable(string $type, string $name, $value, bool $lineBreak = true): string {
		$declaration = "$type $name = $value ;";
		if ($lineBreak) $declaration .= PHP_EOL;
		return $declaration;
	}

	public static function kebabToPascal(string $string): string {
		$string[0] = \strtoupper($string[0]);
		$pattern = '/(-\w{1})/';
		return \preg_replace_callback($pattern,
			function ($matches) {
				return \strtoupper($matches[1][1]);
			}, $string);
	}
}

