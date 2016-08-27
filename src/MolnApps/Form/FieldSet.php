<?php

namespace MolnApps\Form;

class FieldSet implements \Countable, FieldSetInterface
{
	private $prefix;
	private $suffix;

	private $fields = [];
	
	private $fieldFactory;

	public function __construct(FieldFactory $fieldFactory)
	{
		$this->fieldFactory = $fieldFactory;
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

		$this->fields[$name] = $this->fieldFactory->createField($name, $type, $label, $values);
		
		return $this;
	}

	public function fieldAttr($name, array $attributes = [])
	{
		$this->fields[$name]->setAttributes($attributes);
	}

	public function build(array $values = [])
	{
		$html = [];

		foreach ($this->fields as $field) {
			$value = isset($values[$field->name]) ? $values[$field->name] : null;

			$html[] = $field->build($value);
		}

		return implode("\r\n", $html);
	}
}