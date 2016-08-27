<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\AbstractCustomField;
use \MolnApps\Form\Field\Field;

class RowField extends AbstractCustomField
{
	protected function getMarkup()
	{
		return '
			{label}<br/>
			{input}<br/>
		';
	}
}