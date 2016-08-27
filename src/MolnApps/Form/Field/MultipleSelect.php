<?php

namespace MolnApps\Form\Field;

class MultipleSelect extends Select
{
	protected function isMultiple()
	{
		return true;
	}
}