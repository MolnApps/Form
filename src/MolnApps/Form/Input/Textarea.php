<?php

namespace MolnApps\Form\Input;

class Textarea extends AbstractInput
{
	public function build($value = null)
	{
		$baseAttr = [
			'name' => $this->name,
			'id' => $this->name,
			'rows' => 9,
			'cols' => 60,
		];

		$attributes = $this->getAttributes($baseAttr);

		return sprintf(
			'<textarea %s>%s</textarea>', 
			$attributes,
			$value
		);
	}
}