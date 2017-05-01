<?php

namespace MolnApps\Form;

use \MolnApps\Form\Contracts\Field;
use \MolnApps\Form\Contracts\Input;
use \MolnApps\Form\Contracts\Label;

class BaseField implements Field
{
	private $input;
	private $label;

	public function __construct(Input $input, Label $label)
	{
		$this->input = $input;
		$this->label = $label;

		if ($this->shouldInlineLabel()) {
			$this->label->top($this->input);
		}

		$this->customizeLabel($this->label);
		$this->customizeInput($this->input);
	}

	public function setAttributes(array $attributes)
	{
		return $this->input->setAttributes($attributes);
	}

	public function setLabelAttributes(array $attributes)
	{
		return $this->label->setAttributes($attributes);
	}

	public function build($value = null)
	{
		return $this->interpolate($this->getDictionary($value), $this->getMarkup());	
	}

	public function identifier()
	{
		return $this->input->identifier();
	}

	public function type()
	{
		return $this->input->type();
	}

	private function interpolate(array $dictionary, $markup)
	{
		return str_replace(array_keys($dictionary), array_values($dictionary), $markup);
	}

	private function getDictionary($value)
	{
		return array_merge($this->getBaseDictionary($value), $this->getCustomDictionary());
	}

	private function getBaseDictionary($value)
	{
		return [
			'{label}' => $this->label->build($value),
			'{input}' => $this->input->build($value),
		];
	}

	protected function getCustomDictionary()
	{
		return [];
	}

	protected function getMarkup()
	{
		if ($this->shouldInlineLabel()) {
			return '{label}<br/>';
		}

		return '{label}<br/>{input}<br/>';
	}

	protected function customizeLabel($label)
	{
		// Override
	}

	protected function customizeInput($input)
	{
		// Override
	}

	private function shouldInlineLabel()
	{
		return $this->type() == 'checkbox';
	}
}