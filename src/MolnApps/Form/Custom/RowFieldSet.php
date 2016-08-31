<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\BaseFieldSet;

use \MolnApps\Form\Input\Input;
use \MolnApps\Form\Input\Label;

class RowFieldSet extends BaseFieldSet
{
	public function build(array $values = [])
	{
		return '<div class="row">'.parent::build($values).'</div>';
	}
}