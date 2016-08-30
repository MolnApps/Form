<?php

namespace MolnApps\Form;

use \MolnApps\Form\Field\Field;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
	protected function assertMarkup($expectedMarkup, $result)
	{
		$expectedMarkup = $this->cleanMarkup($expectedMarkup);
		$result = $this->cleanMarkup($result);

		$this->assertEquals($expectedMarkup, $result);
	}

	private function cleanMarkup($markup)
	{
		return trim(str_replace(["\r", "\n", "\t"], '', $markup));
	}

	protected function createFieldMock()
	{
		$fieldMock = $this->createMock(Field::class);
		
		$fieldMock->method('build')->willReturn('<div>My mock</div>');
		$fieldMock->method('identifier')->willReturn('myMock');

		return $fieldMock;
	}
}