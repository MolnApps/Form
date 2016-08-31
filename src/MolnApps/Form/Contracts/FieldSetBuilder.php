<?php

namespace MolnApps\Form\Contracts;

interface FieldSetBuilder
{
	public function prefix($prefix);
	public function suffix($prefix);
	
	public function addField(Field $field);
	
	public function field($name, $type, $label, array $values = []);
	public function attributes(array $attributes, $name = null);
	public function validation($key = null);
}