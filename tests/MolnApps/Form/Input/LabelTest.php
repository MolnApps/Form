<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\TestCase;

use \MolnApps\Form\Contracts\Label as LabelInterface;

class LabelTest extends TestCase
{
	/** @test */
	public function it_implements_label_interface()
	{
		$label = new Label('lastName', 'Last name');

		$this->assertInstanceOf(LabelInterface::class, $label);
	}

	/** @test */
	public function it_builds_a_label()
	{
		$label = new Label('lastName', 'Last name');

		$html = $label->build();

		$this->assertMarkup(
			'<label for="lastName">Last name</label>', 
			$html
		);
	}

	/** @test */
	public function it_accepts_a_input_at_the_top()
	{
		$label = new Label('agree', 'Agree to Terms of Service');
		
		$input = Factory::make()->createInput('agree', 'checkbox');
		$label->top($input);

		$html = $label->build();

		$this->assertMarkup(
			'<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="1" /> 
				Agree to Terms of Service
			</label>', 
			$html
		);
	}

	/** @test */
	public function it_accepts_a_input_at_the_top_and_renders_with_value()
	{
		$label = new Label('agree', 'Agree to Terms of Service');
		
		$input = Factory::make()->createInput('agree', 'checkbox');
		$label->top($input);

		$html = $label->build(true);

		$this->assertMarkup(
			'<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="1" checked="checked" /> 
				Agree to Terms of Service
			</label>', 
			$html
		);
	}
}