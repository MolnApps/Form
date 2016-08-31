<?php

namespace MolnApps\Form\Contracts;

interface InputFactory
{
	public function createInput($name, $type, array $values = []);
	public function createLabel($name, $label);
}