<?php

namespace MolnApps\Form\Custom;

use \MolnApps\Form\TestCase;

use \MolnApps\Form\Input\Factory as InputFactory;

class DivFieldSetTest extends TestCase
{
	/** @test */
	public function it_returns_the_markup_for_multiple_registered_fields_with_filled_values()
	{
		$fieldSet = new DivFieldSet(new InputFactory);

		$fieldSet->field('clientCode', 'text', 'Client code');

		$fieldSet->field('supplier', 'textarea', 'Supplier');

		$fieldSet->field('product', 'select', 'Product', [
			'moln_report_basic' => 'Moln Report Basic',
			'moln_report_plus' => 'Moln Report Plus',
		]);
		$fieldSet->attributes(['class' => 'molnSelect']);

		$fieldSet->field('products', 'multipleSelect', 'Product', [
			'moln_report_basic_monthly' => 'Moln Report Basic Monthly',
			'moln_report_plus_monthly' => 'Moln Report Plus Monthly',
			'moln_report_basic_yearly' => 'Moln Report Basic Yearly',
			'moln_report_plus_yearly' => 'Moln Report Plus Yearly',
		]);
		$fieldSet->attributes(['class' => 'molnSelect']);

		$fieldSet->field('agree', 'checkbox', 'Agreenment');

		$result = $fieldSet->build([
			'clientCode' => 'foobar',
			'supplier' => 'Lorem ipsum dolor sit amet',
			'product' => 'moln_report_plus',
			'products' => ['moln_report_basic_monthly', 'moln_report_plus_yearly'],
		]);

		$this->assertMarkup('
			<div class="Form__fieldset">
				<div class="Form__field">
					<label for="clientCode" class="Form__label">Client code</label><br/>
					<input type="text" name="clientCode" id="clientCode" value="foobar" class="Form__input" /><br/>
				</div>
				<div class="Form__field">
					<label for="supplier" class="Form__label">Supplier</label><br/>
					<textarea name="supplier" id="supplier" rows="9" cols="60" class="Form__textarea">Lorem ipsum dolor sit amet</textarea><br/>
				</div>
				<div class="Form__field">
					<label for="product" class="Form__label">Product</label><br/>
					<select name="product" id="product" class="Form__select molnSelect">
						<option value="moln_report_basic">Moln Report Basic</option>
						<option value="moln_report_plus" selected="selected">Moln Report Plus</option>
					</select><br/>
				</div>
				<div class="Form__field">
					<label for="products" class="Form__label">Product</label><br/>
					<select name="products" id="products" class="Form__select Form__select--multiple molnSelect" multiple>
						<option value="moln_report_basic_monthly" selected="selected">Moln Report Basic Monthly</option>
						<option value="moln_report_plus_monthly">Moln Report Plus Monthly</option>
						<option value="moln_report_basic_yearly">Moln Report Basic Yearly</option>
						<option value="moln_report_plus_yearly" selected="selected">Moln Report Plus Yearly</option>
					</select><br/>
				</div>
				<div class="Form__field">
					<label for="agree" class="Form__label">
						<input type="checkbox" name="agree" id="agree" value="1" class="Form__checkbox" /> 
						Agreenment
					</label><br/>
				</div>
			</div>
		', $result);
	}

	/** @test */
	public function it_mixes_two_classes()
	{
		$fieldSet = new DivFieldSet(new InputFactory);

		$fieldSet->field('product', 'select', 'Product', [
			'moln_report_basic' => 'Moln Report Basic',
			'moln_report_plus' => 'Moln Report Plus',
		]);
		$fieldSet->attributes(['class' => 'molnSelect']);

		$result = $fieldSet->build([
			'product' => 'moln_report_plus',
		]);

		$this->assertMarkup('
			<div class="Form__fieldset">
				<div class="Form__field">
					<label for="product" class="Form__label">Product</label><br/>
					<select name="product" id="product" class="Form__select molnSelect">
						<option value="moln_report_basic">Moln Report Basic</option>
						<option value="moln_report_plus" selected="selected">Moln Report Plus</option>
					</select><br/>
				</div>
			</div>
		', $result);
	}
}