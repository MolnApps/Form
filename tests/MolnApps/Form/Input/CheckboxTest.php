<?php

namespace MolnApps\Form\Input;

use \MolnApps\Form\TestCase;

class CheckboxTest extends TestCase
{
	/** @test */
	public function it_builds_a_input_with_default_value_of_1()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');

		$html = $input->build();

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="1" />', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_custom_value()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox', 'agree');

		$html = $input->build();

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="agree" />', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_checked_attribute_if_value_matches()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');

		$html = $input->build('1');

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="1" checked="checked" />', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_with_checked_attribute_if_true_is_passed_as_value()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox', 'agree');

		$html = $input->build(true);

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="agree" checked="checked" />', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_without_checked_attribute_if_value_does_not_match()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');

		$html = $input->build('2');

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="1" />', 
			$html
		);
	}

	/** @test */
	public function it_builds_a_input_without_checked_attribute_if_false_is_passed_as_value()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox', 'agree');

		$html = $input->build(false);

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="agree" />', 
			$html
		);
	}

	/** @test */
	public function it_accepts_additional_attributes()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');
		
		$input->setAttributes([
			'class' => 'Form__checkbox', 
			'id' => 'c_agreeToTerms'
		]);

		$html = $input->build();

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="c_agreeToTerms" value="1" class="Form__checkbox" />',
			$html
		);
	}

	/** @test */
	public function it_can_override_default_value_with_custom_attributes()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');
		
		$input->setAttributes(['value' => 'bar']);

		$html = $input->build();

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="bar" />', 
			$html
		);
	}

	/** @test */
	public function it_can_override_custom_value_with_custom_attributes()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox', 'foo');
		
		$input->setAttributes(['value' => 'bar']);

		$html = $input->build();

		$this->assertMarkup(
			'<input type="checkbox" name="agreeToTerms" id="agreeToTerms" value="bar" />', 
			$html
		);
	}

	/** @test */
	public function it_returns_input_identifier()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');

		$this->assertMarkup('agreeToTerms', $input->identifier());
	}

	/** @test */
	public function it_returns_input_type()
	{
		$input = new Checkbox('agreeToTerms', 'checkbox');

		$this->assertMarkup('checkbox', $input->type());
	}
}