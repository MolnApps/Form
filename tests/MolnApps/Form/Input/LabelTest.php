<?php

namespace MolnApps\Form\Input;

class LabelTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_builds_a_label()
	{
		$label = new Label('lastName', 'Last name');

		$html = $label->build();

		$this->assertEquals('<label for="lastName">Last name</label>', $html);
	}
}