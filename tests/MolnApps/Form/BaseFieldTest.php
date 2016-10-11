<?php

namespace MolnApps\Form;

use \MolnApps\Form\Contracts\Field;
use \MolnApps\Form\Input\Factory;

class BaseFieldTest extends TestCase
{
	/** @test */
	public function it_can_be_instantiated()
	{
		$input = Factory::make()->createInput('firstName', 'text');
		$label = Factory::make()->createLabel('firstName', 'First name');
		
		$field = new BaseField($input, $label);

		$this->assertInstanceOf(Field::class, $field);
	}

	/** @test */
	public function it_can_be_built()
	{
		$input = Factory::make()->createInput('firstName', 'text');
		$label = Factory::make()->createLabel('firstName', 'First name');
		
		$field = new BaseField($input, $label);
		$html = $field->build();

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" /><br/>
		', $html);
	}

	/** @test */
	public function it_can_be_built_with_value()
	{
		$input = Factory::make()->createInput('firstName', 'text');
		$label = Factory::make()->createLabel('firstName', 'First name');
		
		$field = new BaseField($input, $label);
		$html = $field->build('Johnathan');

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" value="Johnathan" /><br/>
		', $html);
	}

	/** @test */
	public function it_can_be_built_with_custom_attributes_and_value()
	{
		$input = Factory::make()->createInput('firstName', 'text');
		$label = Factory::make()->createLabel('firstName', 'First name');
		
		$field = new BaseField($input, $label);
		$field->setAttributes(['class' => 'Form__text']);
		$html = $field->build('Johnathan');

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" value="Johnathan" class="Form__text" /><br/>
		', $html);
	}

	/** @test */
	public function it_returns_input_identifier()
	{
		$input = Factory::make()->createInput('firstName', 'text');
		$label = Factory::make()->createLabel('firstName', 'First name');
		
		$field = new BaseField($input, $label);
		
		$this->assertMarkup('firstName', $field->identifier());
	}

	/** @test */
	public function it_returns_input_type()
	{
		$input = Factory::make()->createInput('firstName', 'text');
		$label = Factory::make()->createLabel('firstName', 'First name');
		
		$field = new BaseField($input, $label);
		
		$this->assertMarkup('text', $field->type());
	}

	/** @test */
	public function it_handles_checkboxes()
	{
		$input = Factory::make()->createInput('agree', 'checkbox');
		$label = Factory::make()->createLabel('agree', 'Agree to Terms of Service');
		
		$field = new BaseField($input, $label);
		$html = $field->build();
		
		$this->assertMarkup('
			<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="1" /> 
				Agree to Terms of Service
			</label><br/>
		', $html);
	}

	/** @test */
	public function it_handles_checkboxes_with_checked_attribute()
	{
		$input = Factory::make()->createInput('agree', 'checkbox');
		$label = Factory::make()->createLabel('agree', 'Agree to Terms of Service');
		
		$field = new BaseField($input, $label);
		$html = $field->build(true);
		
		$this->assertMarkup('
			<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="1" checked="checked" /> 
				Agree to Terms of Service
			</label><br/>
		', $html);
	}
}