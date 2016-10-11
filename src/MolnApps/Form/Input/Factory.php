<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\Contracts\InputFactory;

class Factory implements InputFactory
{
	public static function make()
	{
		return new static;
	}
	
	public function createInput($name, $type, $values = null)
	{
		$className = '\MolnApps\Form\Input\\' . ucfirst($type);

		if ( ! class_exists($className)) {
			throw new \Exception(sprintf('Class [%s] does not exists', $className));
		}

		return new $className($name, $type, $values);
	}

	public function createLabel($name, $label)
	{
		return new Label($name, $label);
	}
}