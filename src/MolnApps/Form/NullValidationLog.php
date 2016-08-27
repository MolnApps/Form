<?php

namespace MolnApps\Form;

class NullValidationLog implements ValidationLog
{
	public function getMessages($key)
	{
		return '';
	}
}