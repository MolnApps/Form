<?php

namespace MolnApps\Form;

use \MolnApps\Form\Field\Field;
use \MolnApps\Form\Field\Factory;

abstract class AbstractCustomFieldSet implements \Countable, FieldFactory, FieldSetInterface
{
	protected $fieldFactory;
	protected $fieldSet;

	public function __construct()
	{
		$this->fieldFactory = new Factory;
		$this->fieldSet = new FieldSet($this);
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

	// ! FieldSetInterface

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

	public function fieldAttr($name, array $attributes = [])
	{
		$this->fieldSet->fieldAttr($name, $attributes);

		return $this;
	}
}