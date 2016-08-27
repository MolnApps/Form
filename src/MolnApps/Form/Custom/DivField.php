<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\AbstractCustomField;
use \MolnApps\Form\Field\Field;

class DivField extends AbstractCustomField
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

		$classes = isset($map[$this->type]) ? $map[$this->type] : $map['default'];
		
		return implode(' ', $classes);
	}
}