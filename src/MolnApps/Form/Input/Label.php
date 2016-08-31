<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\Contracts\Label as LabelInterface;

class Label implements LabelInterface
{
	private $name;
	private $label;

	public function __construct($name, $label)
	{
		$this->name = $name;
		$this->label = $label;
	}

	public function build()
	{
		return sprintf('<label for="%s">%s</label>', $this->name, $this->label);
	}
}