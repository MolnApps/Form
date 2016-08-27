<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\AbstractCustomFieldSet;
use \MolnApps\Form\Field\Field;

class RowFieldSet extends AbstractCustomFieldSet
{
	protected function createCustomField(Field $field)
	{
		return new RowField($field);
	}

	public function build(array $values = [])
	{
		return '<div class="row">'.$this->fieldSet->build($values).'</div>';
	}
}