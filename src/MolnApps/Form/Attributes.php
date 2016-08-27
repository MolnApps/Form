<?php

namespace MolnApps\Form;

class Attributes
{
	private $attributes = [];

	public function __construct(array $attributes = [])
	{
		$this->attributes = $attributes;
	}

	public static function make(array $attributes = [])
	{
		return new static($attributes);
	}

	public function get()
	{
		return $this->getAttributes();
	}

	private function getAttributes()
	{
		$output = [];
		
		$output = $this->addValueAttributes($output);
		$output = $this->addNoValueAttributes($output);
		$output = $this->removeEmptyAttributes($output);
		
		return implode(' ', $output);
	}

	private function addValueAttributes(array $output)
	{
		foreach ($this->attributes as $attribute => $value) {
			if ($this->isValueAttribute($attribute)) {
				$output[] = $attribute . '="' . $value .'"';
			}
		}

		return $output;
	}

	private function addNoValueAttributes(array $output)
	{
		foreach ($this->attributes as $attribute => $value) {
			if ($this->isNoValueAttribute($attribute)) {
				$output[] = ($value) ? $attribute : null;
			}
		}

		return $output;
	}

	private function removeEmptyAttributes(array $output)
	{
		return array_filter($output);
	}

	private function isValueAttribute($attribute)
	{
		return ! $this->isNoValueAttribute($attribute);
	}

	private function isNoValueAttribute($attribute)
	{
		$noValueAttr = ['multiple'];

		return in_array($attribute, $noValueAttr);
	}
}