<?php

namespace MolnApps\Form;

use \MolnApps\Form\Contracts\ValidationLog;

class NullValidationLog implements ValidationLog
{
	public function getMessages($key)
	{
		return '';
	}
}