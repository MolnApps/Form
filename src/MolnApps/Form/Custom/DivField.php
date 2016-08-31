<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\BaseField;

class DivField extends BaseField
{
	protected function getMarkup()
	{
		return '
			<div class="{classes}">
				{label}<br/>
				{input}<br/>
			</div>
		';
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
			'textarea' => ['field', 'double'],
			'default' => ['field'],
		];

		$type = $this->type();

		$classes = isset($map[$type]) ? $map[$type] : $map['default'];
		
		return implode(' ', $classes);
	}
}