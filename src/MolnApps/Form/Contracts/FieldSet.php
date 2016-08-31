<?php

namespace MolnApps\Form\Contracts;

interface FieldSet
{
	public function build(array $values = []);
}