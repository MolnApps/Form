<?php

namespace MolnApps\Form;

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
}