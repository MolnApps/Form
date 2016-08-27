<?php

namespace MolnApps\Form;

interface FieldFactory
{
	public function createField($name, $type, $label, array $values = []);
}