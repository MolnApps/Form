<?php

namespace MolnApps\Form;

use \MolnApps\Form\Field\Field;

abstract class AbstractCustomField implements Field
{
	private $field;

	public function __construct(Field $field)
	{
		$this->field = $field;
	}

	public function __get($name)
	{
		return $this->field->$name;
	}

	public function setAttributes(array $attributes)
	{
		return $this->field->setAttributes($attributes);
	}

	public function build($value = null)
	{
		$dictionary = array_merge($this->getDictionary($value), $this->getCustomDictionary());

		$markup = $this->getMarkup();
		
		return str_replace(array_keys($dictionary), array_values($dictionary), $markup);
	}

	private function getDictionary($value)
	{
		return [
			'{label}' => $this->getLabel(),
			'{input}' => $this->getInput($value),
		];
	}

	abstract protected function getMarkup();

	protected function getCustomDictionary()
	{
		return [];
	}

	private function getInput($value)
	{
		return $this->field->build($value);
	}

	private function getLabel()
	{
		return Label::make($this->field->name, $this->field->label)->build();
	}
}