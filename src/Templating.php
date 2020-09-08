<?php

namespace WMDE\VueJsTemplating;

class Templating {

	protected
		$components = [];

	/**
	 * @param string $template
	 * @param array $data
	 * @param callable[] $filters
	 *
	 * @return string
	 */
	public function render( $template, array $data, array $filters = [] ) {
		$component = new Component( $template, $filters );
		$component->addComponents($this->components);
		return $component->render( $data );
	}

	/**
	 * Add a dynamic component registration
	 *
	 * @param          $identifier
	 * @param callable $callback
	 */
	public function addComponent ($identifier, callable $callback)
	{
		$this->components[$identifier] = $callback;
	}
}
