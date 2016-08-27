<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\AbstractCustomFieldSet;
use \MolnApps\Form\Field\Field;

class DivFieldSet extends AbstractCustomFieldSet
{
	protected function createCustomField(Field $field)
	{
		return new DivField($field);
	}

	public function build(array $values = [])
	{
		return '<div class="fieldset">'.$this->fieldSet->build($values).'</div>';
	}
}