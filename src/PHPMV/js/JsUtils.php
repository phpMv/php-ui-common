<?php
namespace PHPMV\js;

/**
 * Javascript utilities.
 * PHPMV\js$JsUtils
 * This class is part of php-ui-common
 *
 * @author jc
 * @version 1.0.0
 *
 */
class JsUtils {

	/**
	 * Returns a JSON string from an object.
	 *
	 * @param mixed $object
	 * @return string
	 */
	public static function objectToJSON($object): string {
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
	 * Add script tags to a javascript code.
	 *
	 * @param string $script
	 * @return string
	 */
	public static function wrapScript(string $script): string {
		if ($script == null) {
			return "";
		}
		if (\substr($script, 0, strlen("<script>")) !== "<script>") {
			$script = "<script>$script</script>";
		}
		return $script;
	}
}

