<?php

namespace MolnApps\Form\Input;

class TextareaTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_builds_a_input()
	{
		$input = new Textarea('message', 'textarea');

		$html = $input->build();

		$this->assertEquals(
			'<textarea name="message" id="message" rows="9" cols="60"></textarea>', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_value()
	{
		$input = new Textarea('message', 'textarea');

		$html = $input->build('Foo bar baz');

		$this->assertEquals(
			'<textarea name="message" id="message" rows="9" cols="60">Foo bar baz</textarea>', 
			$html
		);
	}

	/** @test */
	public function it_accepts_additional_attributes()
	{
		$input = new Textarea('message', 'textarea');
		$input->setAttributes([
			'class' => 'Form__textarea', 
			'id' => 'c_message'
		]);

		$html = $input->build();

		$this->assertEquals(
			'<textarea name="message" id="c_message" rows="9" cols="60" class="Form__textarea"></textarea>', 
			$html
		);
	}

	/** @test */
	public function it_returns_input_identifier()
	{
		$input = new Textarea('message', 'textarea');

		$this->assertEquals('message', $input->identifier());
	}

	/** @test */
	public function it_returns_input_type()
	{
		$input = new Textarea('message', 'textarea');

		$this->assertEquals('textarea', $input->type());
	}
}