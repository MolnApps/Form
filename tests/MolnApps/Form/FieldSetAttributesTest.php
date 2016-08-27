<?php

namespace MolnApps\Form;

use \MolnApps\Form\Custom\RowFieldSet;

class FieldSetAttributesTest extends TestCase
{
	private $fieldSet;
	
	protected function setUp()
	{
		$this->fieldSet = new BaseFieldSet(new RowFieldSet);
	}

	/** @test */
	public function it_registers_a_text_field_with_custom_attributes()
	{
		$this->fieldSet->field('firstName', 'text', 'First name');
		$this->fieldSet->attributes(['class' => 'firstName', 'maxlength' => 10], 'firstName');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" class="firstName" maxlength="10" /><br/>
		', $result);
	}

	/** @test */
	public function it_registers_last_added_text_field_custom_attributes_with_fluent_api()
	{
		$this->fieldSet->text('firstName', 'First name')->attributes(['maxlength' => '10']);

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" maxlength="10" /><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_textarea_field_with_custom_attributes()
	{
		$this->fieldSet->field('description', 'textarea', 'Description');
		$this->fieldSet->attributes(['placeholder' => 'Lorem ipsum dolor'], 'description');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="description">Description</label><br/>
			<textarea name="description" id="description" rows="9" cols="60" placeholder="Lorem ipsum dolor"></textarea><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_select_field_with_custom_attributes()
	{
		$this->fieldSet->field('choose', 'select', 'Choose', ['foo' => 'bar']);
		$this->fieldSet->attributes(['class' => 'MolnSelect'], 'choose');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="choose">Choose</label><br/>
			<select name="choose" id="choose" class="MolnSelect">
				<option value="foo">bar</option>
			</select><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_multiple_select_field_with_custom_attributes()
	{
		$this->fieldSet->field('choose', 'multipleSelect', 'Choose', ['foo' => 'bar']);
		$this->fieldSet->attributes(['class' => 'MolnSelect'], 'choose');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="choose">Choose</label><br/>
			<select name="choose" id="choose" class="MolnSelect" multiple>
				<option value="foo">bar</option>
			</select><br/>
		', $result);
	}
}