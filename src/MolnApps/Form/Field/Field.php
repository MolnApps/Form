<?php

namespace MolnApps\Form\Field;

interface Field
{
	public function setAttributes(array $attributes);
	public function build($value = null);
}