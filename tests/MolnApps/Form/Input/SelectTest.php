<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\TestCase;

class SelectTest extends TestCase
{
	/** @test */
	public function it_builds_a_select_without_options()
	{
		$input = new Select('country', 'select');

		$html = $input->build();

		$this->assertMarkup(
			'<select name="country" id="country"></select>', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_select_with_options()
	{
		$options = [
			'DE' => 'Germany', 
			'IT' => 'Italy', 
			'UK' => 'United Kingdom'
		];

		$input = new Select('country', 'select', $options);

		$html = $input->build();

		$this->assertMarkup(
			'<select name="country" id="country">
				<option value="DE">Germany</option>
				<option value="IT">Italy</option>
				<option value="UK">United Kingdom</option>
			</select>', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_value_without_options()
	{
		$input = new Select('country', 'select');

		$html = $input->build('Foo bar baz');

		$this->assertMarkup(
			'<select name="country" id="country"></select>', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_value_with_options()
	{
		$options = [
			'DE' => 'Germany', 
			'IT' => 'Italy', 
			'UK' => 'United Kingdom'
		];

		$input = new Select('country', 'select', $options);

		$html = $input->build('IT');

		$this->assertMarkup(
			'<select name="country" id="country">
				<option value="DE">Germany</option>
				<option value="IT" selected="selected">Italy</option>
				<option value="UK">United Kingdom</option>
			</select>', 
			$html
		);
	}

	/** @test */
	public function it_accepts_additional_attributes()
	{
		$options = [
			'DE' => 'Germany', 
			'IT' => 'Italy', 
			'UK' => 'United Kingdom'
		];

		$input = new Select('country', 'select', $options);

		$input->setAttributes([
			'class' => 'Form__select', 
			'id' => 'c_country'
		]);

		$html = $input->build();

		$this->assertMarkup(
			'<select name="country" id="c_country" class="Form__select">
				<option value="DE">Germany</option>
				<option value="IT">Italy</option>
				<option value="UK">United Kingdom</option>
			</select>', 
			$html
		);
	}

	/** @test */
	public function it_returns_input_identifier()
	{
		$input = new Select('country', 'select');

		$this->assertEquals('country', $input->identifier());
	}

	/** @test */
	public function it_returns_input_type()
	{
		$input = new Select('country', 'select');

		$this->assertEquals('select', $input->type());
	}
}