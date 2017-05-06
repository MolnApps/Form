<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\Contracts\InputFactory;

class Factory implements InputFactory
{
	public static function make()
	{
		return new static;
	}

	public function registerInput($id, $ns)
	{
		$this->inputs[$id] = $ns;
	}
	
	public function createInput($name, $type, $values = null)
	{
		if ( ! $this->typeIsRegistered($type)) {
			return $this->instantiateWithClass($this->getDefaultClassname($type), $name, $type, $values);
		}

		if ($this->typeHasCallback($type)) {
			return $this->instantiateWithCallback($type);
		}

		if ($this->typeHasClassname($type)) {
			return $this->instantiateWithClass($this->getRegisteredClassname($type), $name, $type, $values);
		}
	}

	public function createLabel($name, $label)
	{
		return new Label($name, $label);
	}

	private function typeIsRegistered($type)
	{
		return isset($this->inputs[$type]);
	}

	private function getDefaultClassname($type)
	{
		return '\MolnApps\Form\Input\\' . ucfirst($type);
	}

	private function typeHasCallback($type)
	{
		return $this->inputs[$type] instanceof \Closure;
	}

	private function typeHasClassname($type)
	{
		return is_string($this->inputs[$type]);
	}

	private function instantiateWithCallback($type)
	{
		return call_user_func($this->inputs[$type]);
	}

	private function getRegisteredClassname($type)
	{
		return $this->inputs[$type];
	}

	private function instantiateWithClass($className, $name, $type, $values)
	{
		if ( ! class_exists($className)) {
			throw new \Exception(sprintf('Class [%s] does not exists', $className));
		}

		return new $className($name, $type, $values);
	}
}