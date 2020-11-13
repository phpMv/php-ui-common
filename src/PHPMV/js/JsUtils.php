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
	 * @param object $object
	 * @return string
	 */
	public static function objectToJSON(object $object): string {
		if (\method_exists($object, 'toArray')) {
			$array = $object->toArray();
		} else {
			$array = (array) $object;
		}
		return \json_encode($array, \JSON_PRETTY_PRINT | \JSON_NUMERIC_CHECK);
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
		if (\substr($script, 0, strlen("<script>")) === "<script>") {
			$script = "<script>$script</script>";
		}
		return script;
	}
}

