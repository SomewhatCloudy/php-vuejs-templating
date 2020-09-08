<?php

namespace WMDE\VueJsTemplating\JsParsing;

class VariableAccess implements ParsedExpression {

	/**
	 * @var string[]
	 */
	private $pathParts;

	public function __construct( array $pathParts ) {
		$this->pathParts = $pathParts;
	}

	/**
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function evaluate( array $data ) {
		$value = $data;
		foreach ( $this->pathParts as $key_index=>$key ) {

			// Is Length check of an array?
			$last_part = $key_index === count($this->pathParts) - 1;
			if (is_array($value) && $key === 'length' && $last_part)
			{
				return count($value);
			}

			// Class attr check
			else if (is_object($value))
			{
				$value = $value->{$key};
			}

			// No array key
			else if ( !array_key_exists( $key, $value ) ) {
				$value[$key] = '';
				return $value[$key];
			}

			// Normal array key
			else
			{
				$value = $value[$key];
			}
		}
		return $value;
	}

}
