<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\Contracts\Label as LabelInterface;
use \MolnApps\Form\Contracts\Input as InputInterface;

class Label implements LabelInterface
{
	private $name;
	private $label;

	private $top;

	public function __construct($name, $label)
	{
		$this->name = $name;
		$this->label = $label;
	}

	public function top(InputInterface $input)
	{
		$this->top = $input;
	}

	public function build($value = null)
	{
		$top = $this->top 
			? $this->top->build($value) . ' ' 
			: null;

		return sprintf('<label for="%s">%s%s</label>', $this->name, $top, $this->label);
	}
}