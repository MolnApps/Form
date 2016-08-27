<?php

namespace MolnApps\Form;

use \MolnApps\Form\Field\Field;

class BaseFieldSet implements \Countable, FieldSet, FieldSetBuilder
{
	private $prefix;
	private $suffix;

	private $currentName;

	private $fields = [];
	private $validationKey = [];
	
	private $fieldFactory;
	
	private $validationLog;

	public function __construct(FieldFactory $fieldFactory, ValidationLog $validationLog = null)
	{
		$this->fieldFactory = $fieldFactory;
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

	public function field($name, $type, $label, array $values = [])
	{
		$name = $this->prefix . $name . $this->suffix;

		$this->currentName = $name;

		$this->fields[$name] = $this->fieldFactory->createField($name, $type, $label, $values);
		
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
		$value = isset($values[$field->name]) 
			? $values[$field->name] 
			: null;

		return $field->build($value);
	}

	private function getFieldValidation(Field $field)
	{
		$validationKey = isset($this->validationKey[$field->name]) 
			? $this->validationKey[$field->name] 
			: $field->name;

		return $this->validationLog->getMessages($validationKey);
	}
}