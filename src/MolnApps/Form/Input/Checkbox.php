<?php

namespace MolnApps\Form\Input;

class Checkbox extends AbstractInput
{
	public function build($value = null)
	{
		if ( ! $this->values) {
			$this->values = ['1'];
		}

		$baseAttr = [
			'type' => 'checkbox',
			'name' => $this->name,
			'id' => $this->name,
			'value' => $this->values[0],
		];

		if ($value == $this->values[0]) {
			$baseAttr['checked'] = 'checked';
		}

		$attributes = $this->getAttributes($baseAttr);
		
		return sprintf(
			'<input %s />', 
			$attributes
		);
	}
}