<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\BaseFieldSet;

use \MolnApps\Form\Contracts\Input;
use \MolnApps\Form\Contracts\Label;

class DivFieldSet extends BaseFieldSet
{
	protected function createField(Input $input, Label $label)
	{
		return new DivField($input, $label);
	}

	public function build(array $values = [])
	{
		return '<div class="Form__fieldset">'.parent::build($values).'</div>';
	}
}