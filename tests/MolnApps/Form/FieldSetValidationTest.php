<?php

namespace MolnApps\Form;

use \MolnApps\Form\Custom\RowFieldSet;

class FieldSetValidationTest extends TestCase
{
	private $fieldSet;
	private $validationLog;
	
	protected function setUp()
	{
		$this->validationLog = $this->createMock(ValidationLog::class);

		$map = [
			['name', '<p class="validate error name">Please provide a first name</p>'],
			['lastName', '<p class="validate error lastName">Please provide a last name</p>'],
		];
		
		$this->validationLog
			->method('getMessages')
			->will($this->returnValueMap($map));

		$this->fieldSet = new BaseFieldSet(new RowFieldSet, $this->validationLog);
	}

	/** @test */
	public function it_will_display_validation_message()
	{
		$this->fieldSet->text('lastName', 'Last name');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="lastName">Last name</label><br/>
			<input type="text" name="lastName" id="lastName" /><br/>
			<p class="validate error lastName">Please provide a last name</p>
		', $result);
	}

	/** @test */
	public function it_provides_a_method_to_define_a_different_validation_key()
	{
		$this->fieldSet->text('firstName', 'First name')->validation('name');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" /><br/>
			<p class="validate error name">Please provide a first name</p>
		', $result);
	}

	/** @test */
	public function it_will_display_no_validation_message_if_none_is_returned_by_validation_log()
	{
		$this->fieldSet->text('jobTitle', 'Job title');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="jobTitle">Job title</label><br/>
			<input type="text" name="jobTitle" id="jobTitle" /><br/>
		', $result);
	}
}