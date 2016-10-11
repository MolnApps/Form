<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\Attributes;
use \MolnApps\Form\Contracts\Input;

abstract class AbstractInput implements Input
{
	protected $name;
	protected $type;
	protected $values = [];

	private $attributes = [];

	public function __construct($name, $type, $values = null)
	{
		$values = (array)$values;

		$this->name = $name;
		$this->type = $type;
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

	public function identifier()
	{
		return $this->name;
	}

	public function type()
	{
		return $this->type;
	}
}