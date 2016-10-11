<?php

namespace MolnApps\Form\Input;

class TextTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_builds_a_input()
	{
		$input = new Text('firstName', 'text');

		$html = $input->build();

		$this->assertEquals(
			'<input type="text" name="firstName" id="firstName" />', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_value()
	{
		$input = new Text('firstName', 'text');

		$html = $input->build('Foo bar baz');

		$this->assertEquals(
			'<input type="text" name="firstName" id="firstName" value="Foo bar baz" />', 
			$html
		);
	}

	/** @test */
	public function it_accepts_additional_attributes()
	{
		$input = new Text('firstName', 'text');
		$input->setAttributes([
			'class' => 'Form__text', 
			'id' => 'c_firstName'
		]);

		$html = $input->build();

		$this->assertEquals(
			'<input type="text" name="firstName" id="c_firstName" class="Form__text" />', 
			$html
		);
	}

	/** @test */
	public function it_returns_input_identifier()
	{
		$input = new Text('firstName', 'text');

		$this->assertEquals('firstName', $input->identifier());
	}

	/** @test */
	public function it_returns_input_type()
	{
		$input = new Text('firstName', 'text');

		$this->assertEquals('text', $input->type());
	}
}