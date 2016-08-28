<?php

namespace MolnApps\Form;

use \MolnApps\Form\Field\Field;
use \MolnApps\Form\Field\Factory;

abstract class AbstractCustomFieldSet implements \Countable, FieldFactory, FieldSet, FieldSetBuilder
{
	protected $fieldFactory;
	protected $fieldSet;

	public function __construct(ValidationLog $validationLog = null)
	{
		$this->fieldFactory = new Factory;
		$this->fieldSet = new BaseFieldSet($this, $validationLog);
	}

	public function __call($name, $args)
	{
		return call_user_func_array([$this->fieldSet, $name], $args);
	}

	// ! Countable

	public function count()
	{
		return $this->fieldSet->count();
	}

	// ! FieldFactoryInterface

	public function createField($name, $type, $label, array $values = [])
	{
		return $this->createCustomField($this->fieldFactory->createField($name, $type, $label, $values));
	}

	protected function createCustomField(Field $field)
	{
		// Override this method to return a custom implementation
		return $field;
	}

	// ! FieldSetBuilder

	public function prefix($prefix)
	{
		$this->fieldSet->prefix($prefix);

		return $this;
	}

	public function suffix($suffix)
	{
		$this->fieldSet->suffix($suffix);

		return $this;
	}

	public function field($name, $type, $label, array $values = [])
	{
		$this->fieldSet->field($name, $type, $label, $values);

		return $this;
	}

	public function attributes(array $attributes, $name = null)
	{
		$this->fieldSet->attributes($attributes, $name);

		return $this;
	}

	public function validation($key = null)
	{
		$this->fieldSet->validation($key);

		return $this;
	}
}