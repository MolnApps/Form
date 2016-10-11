<?php

namespace MolnApps\Form;

use \MolnApps\Form\Contracts\FieldSet;
use \MolnApps\Form\Contracts\FieldSetBuilder;
use \MolnApps\Form\Contracts\InputFactory;
use \MolnApps\Form\Contracts\ValidationLog;
use \MolnApps\Form\Contracts\Input;
use \MolnApps\Form\Contracts\Label;
use \MolnApps\Form\Contracts\Field;

class BaseFieldSet implements \Countable, FieldSet, FieldSetBuilder
{
	private $prefix;
	private $suffix;

	private $currentName;

	private $fields = [];
	private $validationKey = [];
	
	private $inputFactory;
	
	private $validationLog;

	public function __construct(InputFactory $inputFactory, ValidationLog $validationLog = null)
	{
		$this->inputFactory = $inputFactory;
		$this->validationLog = $validationLog ?: new NullValidationLog;
	}

	public function count()
	{
		return count($this->fields);
	}

	public function prefix($prefix)
	{
		$this->prefix = $prefix;

		return $this;
	}

	public function suffix($suffix)
	{
		$this->suffix = $suffix;

		return $this;
	}

	public function text($name, $label)
	{
		return $this->field($name, 'text', $label);
	}

	public function textarea($name, $label)
	{
		return $this->field($name, 'textarea', $label);
	}

	public function select($name, $label, array $values = [])
	{
		return $this->field($name, 'select', $label, $values);
	}

	public function multipleSelect($name, $label, array $values = [])
	{
		return $this->field($name, 'multipleSelect', $label, $values);
	}

	public function checkbox($name, $label, $value)
	{
		return $this->field($name, 'checkbox', $label, (array)$value);
	}

	public function field($name, $type, $label, $values = null)
	{
		$name = $this->prefix . $name . $this->suffix;

		return $this->addField($this->getField($name, $type, $label, $values));
	}

	protected function getField($name, $type, $label, $values = null)
	{
		$input = $this->inputFactory->createInput($name, $type, $values);
		$label = $this->inputFactory->createLabel($name, $label);
		
		return $this->createField($input, $label);
	}

	protected function createField(Input $input, Label $label)
	{
		return new BaseField($input, $label);
	}

	public function addField(Field $field)
	{
		$name = $field->identifier();

		$this->currentName = $name;

		$this->fields[$name] = $field;

		return $this;
	}

	public function validation($key = null)
	{
		$key = $key ?: $this->currentName;

		$this->validationKey[$this->currentName] = $key;
		
		return $this;
	}

	public function attributes(array $attributes, $name = null)
	{
		$name = $name ?: $this->currentName;

		$this->fields[$name]->setAttributes($attributes);

		return $this;
	}

	public function build(array $values = [])
	{
		$html = [];

		foreach ($this->fields as $field) {
			$html[] = $this->getFieldInput($field, $values);
			$html[] = $this->getFieldValidation($field);
		}

		return implode("\r\n", $html);
	}

	private function getFieldInput(Field $field, array $values)
	{
		$value = isset($values[$field->identifier()]) 
			? $values[$field->identifier()] 
			: null;

		return $field->build($value);
	}

	private function getFieldValidation(Field $field)
	{
		$validationKey = isset($this->validationKey[$field->identifier()]) 
			? $this->validationKey[$field->identifier()] 
			: $field->identifier();

		return $this->validationLog->getMessages($validationKey);
	}
}