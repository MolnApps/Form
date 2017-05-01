<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\BaseField;

class DivField extends BaseField
{
	protected function customizeLabel($label)
	{
		$label->addAttributes(['class' => 'Form__label']);
	}

	protected function customizeInput($input)
	{
		$override = [
			'text' => 'input',
			'multipleSelect' => 'select Form__select--multiple',
		];

		$type = $input->type();
		
		if (isset($override[$type])) {
			$type = $override[$type];
		}

		$input->addAttributes(['class' => 'Form__' . $type]);
	}

	protected function getMarkup()
	{
		return '<div class="{classes}">' . parent::getMarkup() . '</div>';
	}

	protected function getCustomDictionary()
	{
		return [
			'{classes}' => $this->getFieldClasses()
		];
	}

	private function getFieldClasses()
	{
		$map = [
			'textarea' => ['Form__field'],
			'default' => ['Form__field'],
		];

		$type = $this->type();

		$classes = isset($map[$type]) ? $map[$type] : $map['default'];
		
		return implode(' ', $classes);
	}
}