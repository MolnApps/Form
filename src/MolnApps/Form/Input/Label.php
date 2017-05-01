<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\Contracts\Label as LabelInterface;
use \MolnApps\Form\Contracts\Input as InputInterface;

use \MolnApps\Form\HasAttributes;

class Label implements LabelInterface
{
	use HasAttributes;

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

		$baseAttr = [
			'for' => $this->name
		];

		return sprintf('<label %s>%s%s</label>', $this->getAttributes($baseAttr), $top, $this->label);
	}
}