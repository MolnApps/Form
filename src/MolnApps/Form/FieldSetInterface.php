<?php

namespace MolnApps\Form;

interface FieldSetInterface
{
	public function prefix($prefix);
	public function suffix($prefix);
	public function field($name, $type, $label, array $values = []);
	public function fieldAttr($name, array $attributes = []);
	public function build(array $values = []);
}