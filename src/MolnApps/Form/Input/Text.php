<?php

namespace MolnApps\Form\Input;

class Text extends AbstractInput
{
	public function build($value = null)
	{
		$baseAttr = [
			'type' => 'text',
			'name' => $this->name,
			'id' => $this->name,
		];

		if ($value) {
			$baseAttr['value'] = $value;
		}

		$attributes = $this->getAttributes($baseAttr);
		
		return sprintf(
			'<input %s />', 
			$attributes
		);
	}
}