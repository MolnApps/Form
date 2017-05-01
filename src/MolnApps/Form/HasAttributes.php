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
		$this->attributes = array_merge($this->attributes, $attributes);

		return $this;
	}

	protected function getAttributes(array $baseAttributes = [])
	{
		$attributes = array_merge($baseAttributes, $this->attributes);

		return Attributes::make($attributes)->get();
	}
}