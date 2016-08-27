<?php

namespace MolnApps\Form\Field;

use \MolnApps\Form\FieldFactory;

class Factory implements FieldFactory
{
	public function createField($name, $type, $label, array $values = [])
	{
		$className = '\MolnApps\Form\Field\\' . ucfirst($type);

		if ( ! class_exists($className)) {
			throw new \Exception(sprintf('Class [%s] does not exists', $className));
		}

		return new $className($name, $type, $label, $values);
	}
}