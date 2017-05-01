<?php

namespace MolnApps\Form\Contracts;

interface Label
{
	public function setAttributes(array $attributes);
	public function build();
}