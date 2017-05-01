<?php

namespace MolnApps\Form\Contracts;

interface FieldSetBuilder
{
	public function prefix($prefix);
	public function suffix($prefix);
	
	public function addField(Field $field);
	
	public function field($name, $type, $label, $values = null);
	public function attributes(array $attributes, $name = null);
	public function labelAttributes(array $attribtues, $name = null);
	public function validation($key = null);
}