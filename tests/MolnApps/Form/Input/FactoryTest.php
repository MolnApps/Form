<?php

namespace MolnApps\Form\Input;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function it_returns_a_text_input()
	{
		$factory = new Factory;
		
		$input = $factory->createInput('firstName', 'text');

		$this->assertInstanceOf(Text::class, $input);
		$this->assertEquals('firstName', $input->identifier());
		$this->assertEquals('text', $input->type());
	}

	/** @test */
	public function it_returns_a_textarea_input()
	{
		$factory = new Factory;
		
		$input = $factory->createInput('message', 'textarea');

		$this->assertInstanceOf(Textarea::class, $input);
		$this->assertEquals('message', $input->identifier());
		$this->assertEquals('textarea', $input->type());
	}

	/** @test */
	public function it_returns_a_select_input()
	{
		$factory = new Factory;

		$options = [
			'DE' => 'Germany',
			'IT' => 'Italy',
			'UK' => 'United Kingdom',
		];
		
		$input = $factory->createInput('country', 'select', $options);

		$this->assertInstanceOf(Select::class, $input);
		$this->assertEquals('country', $input->identifier());
		$this->assertEquals('select', $input->type());
	}

	/** @test */
	public function it_returns_a_multiple_select_input()
	{
		$factory = new Factory;

		$options = [
			'DE' => 'Germany',
			'IT' => 'Italy',
			'UK' => 'United Kingdom',
		];
		
		$input = $factory->createInput('countries', 'multipleSelect', $options);

		$this->assertInstanceOf(MultipleSelect::class, $input);
		$this->assertEquals('countries', $input->identifier());
		$this->assertEquals('multipleSelect', $input->type());
	}

	/** @test */
	public function it_returns_a_checkbox()
	{
		$factory = new Factory;

		$input = $factory->createInput('agree', 'checkbox', 'agree');

		$this->assertInstanceOf(Checkbox::class, $input);
		$this->assertEquals('agree', $input->identifier());
		$this->assertEquals('checkbox', $input->type());
	}

	/** @test */
	public function it_returns_a_label()
	{
		$factory = new Factory;

		$label = $factory->createLabel('lastName', 'Last name');

		$this->assertInstanceOf(Label::class, $label);
	}
}