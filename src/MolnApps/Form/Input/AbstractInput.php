<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\HasAttributes;
use \MolnApps\Form\Contracts\Input;

abstract class AbstractInput implements Input
{
	use HasAttributes;

	protected $name;
	protected $type;
	protected $values = [];

	public function getAttr()
	{
		return $this->attributes;
	}

	public function __construct($name, $type, $values = null)
	{
		$values = (array)$values;

		$this->name = $name;
		$this->type = $type;
		$this->values = $values;
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