<?php

namespace MolnApps\Form\Input;

class MultipleSelect extends Select
{
	protected function isMultiple()
	{
		return true;
	}
}