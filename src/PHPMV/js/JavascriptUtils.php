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
}

