<?php

namespace MolnApps\Form\Contracts;

interface Field
{
	public function setAttributes(array $attributes);
	public function build($value = null);
	public function identifier();
	public function type();
}