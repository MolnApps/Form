<?php

namespace MolnApps\Form\Field;

use \MolnApps\Form\Attributes;

abstract class AbstractField implements Field
{
	public $name;
	public $type;
	public $label;
	protected $values = [];

	private $attributes = [];

	public function __construct($name, $type, $label, array $values = [])
	{
		$this->name = $name;
		$this->type = $type;
		$this->label = $label;	
		$this->values = $values;
	}

	public function setAttributes(array $attributes)
	{
		$this->attributes = $attributes;
	}

	protected function getAttributes(array $baseAttributes = [])
	{
		$attributes = array_merge($baseAttributes, $this->attributes);

		return Attributes::make($attributes)->get();
	}
}