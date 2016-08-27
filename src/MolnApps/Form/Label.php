<?php

namespace MolnApps\Form;

class Label
{
	private $name;
	private $label;

	public function __construct($name, $label)
	{
		$this->name = $name;
		$this->label = $label;
	}

	public static function make($name, $label)
	{
		return new static($name, $label);
	}

	public function build()
	{
		return sprintf('<label for="%s">%s</label>', $this->name, $this->label);
	}
}