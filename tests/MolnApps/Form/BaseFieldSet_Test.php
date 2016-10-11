<?php

namespace MolnApps\Form;

use \MolnApps\Form\Input\Factory as InputFactory;

class FieldSetTest extends TestCase
{
	private $fieldSet;
	
	protected function setUp()
	{
		$this->fieldSet = new BaseFieldSet(new InputFactory);
	}

	/** @test */
	public function it_instantiates_a_field_set()
	{
		$this->assertNotNull($this->fieldSet);
	}

	/** @test */
	public function it_implements_countable()
	{
		$this->assertInstanceOf(\Countable::class, $this->fieldSet);
	}

	/** @test */
	public function it_accepts_a_text_field()
	{
		$this->fieldSet->field('clientCode', 'text', 'Client code');

		$this->assertCount(1, $this->fieldSet);
	}

	/** @test */
	public function it_accepts_a_text_field_with_fluent_interface()
	{
		$this->fieldSet
			->field('clientCode', 'text', 'Client code')
			->field('status', 'text', 'Status');

		$this->assertCount(2, $this->fieldSet);
	}

	/** @test */
	public function it_accepts_a_text_field_with_prefix()
	{
		$this->fieldSet
			->prefix('c_')
			->field('clientCode', 'text', 'Client code');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="c_clientCode">Client code</label><br/>
			<input type="text" name="c_clientCode" id="c_clientCode" /><br/>
		', $result);
	}

	/** @test */
	public function it_accepts_a_text_field_with_suffix()
	{
		$this->fieldSet
			->suffix('_c')
			->field('clientCode', 'text', 'Client code');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="clientCode_c">Client code</label><br/>
			<input type="text" name="clientCode_c" id="clientCode_c" /><br/>
		', $result);
	}

	/** @test */
	public function it_accepts_a_text_field_with_prefix_and_suffix()
	{
		$this->fieldSet
			->prefix('c_')
			->suffix('_c')
			->field('clientCode', 'text', 'Client code');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="c_clientCode_c">Client code</label><br/>
			<input type="text" name="c_clientCode_c" id="c_clientCode_c" /><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_registered_text_input()
	{
		$this->fieldSet->field('clientCode', 'text', 'Client code');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="clientCode">Client code</label><br/>
			<input type="text" name="clientCode" id="clientCode" /><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_registered_textarea()
	{
		$this->fieldSet->field('supplier', 'textarea', 'Supplier');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="supplier">Supplier</label><br/>
			<textarea name="supplier" id="supplier" rows="9" cols="60"></textarea><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_registered_select()
	{
		$this->fieldSet->field('product', 'select', 'Product', [
			'moln_report_basic' => 'Moln Report Basic',
			'moln_report_plus' => 'Moln Report Plus',
		]);

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="product">Product</label><br/>
			<select name="product" id="product">
				<option value="moln_report_basic">Moln Report Basic</option>
				<option value="moln_report_plus">Moln Report Plus</option>
			</select><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_registered_multiple_select()
	{
		$this->fieldSet->field('product', 'multipleSelect', 'Product', [
			'moln_report_basic' => 'Moln Report Basic',
			'moln_report_plus' => 'Moln Report Plus',
		]);

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="product">Product</label><br/>
			<select name="product" id="product" multiple>
				<option value="moln_report_basic">Moln Report Basic</option>
				<option value="moln_report_plus">Moln Report Plus</option>
			</select><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_registered_checkbox()
	{
		$this->fieldSet->field('agree', 'checkbox', 'Agree to Terms of Service');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="1" /> 
				Agree to Terms of Service
			</label><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_registered_field()
	{
		$fieldMock = $this->createFieldMock();

		$this->fieldSet->addField($fieldMock);

		$result = $this->fieldSet->build();

		$this->assertMarkup('<div>My mock</div>', $result);
	}

	/** @test */
	public function it_registers_a_text_field_with_qualified_method()
	{
		$this->fieldSet->text('firstName', 'First name');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="firstName">First name</label><br/>
			<input type="text" name="firstName" id="firstName" /><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_textarea_field_with_qualified_method()
	{
		$this->fieldSet->textarea('description', 'Description');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="description">Description</label><br/>
			<textarea name="description" id="description" rows="9" cols="60"></textarea><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_select_field_with_qualified_method()
	{
		$this->fieldSet->select('product', 'Product', ['moln_report_basic' => 'Moln Report Basic']);

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="product">Product</label><br/>
			<select name="product" id="product">
				<option value="moln_report_basic">Moln Report Basic</option>
			</select><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_multiple_select_field_with_qualified_method()
	{
		$this->fieldSet->multipleSelect('product', 'Product', ['moln_report_basic' => 'Moln Report Basic']);

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="product">Product</label><br/>
			<select name="product" id="product" multiple>
				<option value="moln_report_basic">Moln Report Basic</option>
			</select><br/>
		', $result);
	}

	/** @test */
	public function it_registers_a_checkbox_with_qualified_method()
	{
		$this->fieldSet->checkbox('agree', 'Agree to Terms of Service', 'agree');

		$result = $this->fieldSet->build();

		$this->assertMarkup('
			<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="agree" /> 
				Agree to Terms of Service
			</label><br/>
		', $result);
	}

	/** @test */
	public function it_returns_the_markup_for_multiple_registered_fields_with_filled_values()
	{
		$this->fieldSet->field('clientCode', 'text', 'Client code');

		$this->fieldSet->field('supplier', 'textarea', 'Supplier');

		$this->fieldSet->addField($this->createFieldMock());

		$this->fieldSet->field('product', 'select', 'Product', [
			'moln_report_basic' => 'Moln Report Basic',
			'moln_report_plus' => 'Moln Report Plus',
		]);

		$this->fieldSet->field('products', 'multipleSelect', 'Product', [
			'moln_report_basic_monthly' => 'Moln Report Basic Monthly',
			'moln_report_plus_monthly' => 'Moln Report Plus Monthly',
			'moln_report_basic_yearly' => 'Moln Report Basic Yearly',
			'moln_report_plus_yearly' => 'Moln Report Plus Yearly',
		]);

		$this->fieldSet->field('agree', 'checkbox', 'Agree to Terms of Service', 'agree');

		$result = $this->fieldSet->build([
			'clientCode' => 'foobar',
			'supplier' => 'Lorem ipsum dolor sit amet',
			'product' => 'moln_report_plus',
			'products' => ['moln_report_basic_monthly', 'moln_report_plus_yearly'],
			'agree' => 'agree',
		]);

		$this->assertMarkup('
			<label for="clientCode">Client code</label><br/>
			<input type="text" name="clientCode" id="clientCode" value="foobar" /><br/>
			<label for="supplier">Supplier</label><br/>
			<textarea name="supplier" id="supplier" rows="9" cols="60">Lorem ipsum dolor sit amet</textarea><br/>
			<div>My mock</div>
			<label for="product">Product</label><br/>
			<select name="product" id="product">
				<option value="moln_report_basic">Moln Report Basic</option>
				<option value="moln_report_plus" selected="selected">Moln Report Plus</option>
			</select><br/>
			<label for="products">Product</label><br/>
			<select name="products" id="products" multiple>
				<option value="moln_report_basic_monthly" selected="selected">Moln Report Basic Monthly</option>
				<option value="moln_report_plus_monthly">Moln Report Plus Monthly</option>
				<option value="moln_report_basic_yearly">Moln Report Basic Yearly</option>
				<option value="moln_report_plus_yearly" selected="selected">Moln Report Plus Yearly</option>
			</select><br/>
			<label for="agree">
				<input type="checkbox" name="agree" id="agree" value="agree" checked="checked" /> 
				Agree to Terms of Service
			</label><br/>
		', $result);
	}
}