<?php

namespace MolnApps\Form;

trait HasAttributes
{
	private $attributes = [];

	public function setAttributes(array $attributes)
	{
		$this->attributes = $attributes;
		
		return $this;
	}

	public function addAttributes(array $attributes)
	{
		$this->mergeClassAttributes($attributes);

		$this->attributes = array_merge($this->attributes, $attributes);

		return $this;
	}

	private function mergeClassAttributes(array &$attributes)
	{
		if ( ! isset($this->attributes['class'])) {
			$this->attributes['class'] = '';
		}

		if (isset($attributes['class'])) {
			$this->attributes['class'].= ' ' . $attributes['class'];
			$this->attributes['class'] = trim($this->attributes['class']);
			unset($attributes['class']);
		}
	}

	protected function getAttributes(array $baseAttributes = [])
	{
		$attributes = array_merge($baseAttributes, $this->attributes);

		return Attributes::make($attributes)->get();
	}
}