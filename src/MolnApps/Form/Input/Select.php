<?php

namespace MolnApps\Form\Input;

class Select extends AbstractInput
{
	public function build($value = null)
	{
		$baseAttr = [
			'name' => $this->name,
			'id' => $this->name,
			'multiple' => $this->isMultiple(),
		];
		
		$attributes = $this->getAttributes($baseAttr);

		return sprintf(
			'<select %s>%s</select>', 
			$attributes,
			$this->getOptions($value)
		);
	}

	protected function isMultiple()
	{
		return false;
	}

	private function getOptions($selectedValue)
	{
		$selectedValues = (array)$selectedValue;

		$html = [];

		foreach ($this->values as $value => $label) {
			$selected = in_array($value, $selectedValues) ? ' selected="selected"' : '';

			$html[] = sprintf('<option value="%s"%s>%s</option>', $value, $selected, $label);
		}

		return implode("\r\n", $html);
	}
}