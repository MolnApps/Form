<?php

namespace MolnApps\Form;

use \MolnApps\Form\Custom\DivFieldSet;

class DivFieldSetTest extends TestCase
{
	/** @test */
	public function it_returns_the_markup_for_multiple_registered_fields_with_filled_values()
	{
		$fieldSet = new DivFieldSet;

		$fieldSet->field('clientCode', 'text', 'Client code');

		$fieldSet->field('supplier', 'textarea', 'Supplier');

		$fieldSet->field('product', 'select', 'Product', [
			'moln_report_basic' => 'Moln Report Basic',
			'moln_report_plus' => 'Moln Report Plus',
		]);

		$fieldSet->field('products', 'multipleSelect', 'Product', [
			'moln_report_basic_monthly' => 'Moln Report Basic Monthly',
			'moln_report_plus_monthly' => 'Moln Report Plus Monthly',
			'moln_report_basic_yearly' => 'Moln Report Basic Yearly',
			'moln_report_plus_yearly' => 'Moln Report Plus Yearly',
		]);

		$result = $fieldSet->build([
			'clientCode' => 'foobar',
			'supplier' => 'Lorem ipsum dolor sit amet',
			'product' => 'moln_report_plus',
			'products' => ['moln_report_basic_monthly', 'moln_report_plus_yearly'],
		]);

		$this->assertMarkup('
			<div class="fieldset">
				<div class="field">
					<label for="clientCode">Client code</label><br/>
					<input type="text" name="clientCode" id="clientCode" value="foobar" /><br/>
				</div>
				<div class="field double">
					<label for="supplier">Supplier</label><br/>
					<textarea name="supplier" id="supplier" rows="9" cols="60">Lorem ipsum dolor sit amet</textarea><br/>
				</div>
				<div class="field">
					<label for="product">Product</label><br/>
					<select name="product" id="product">
						<option value="moln_report_basic">Moln Report Basic</option>
						<option value="moln_report_plus" selected="selected">Moln Report Plus</option>
					</select><br/>
				</div>
				<div class="field">
					<label for="products">Product</label><br/>
					<select name="products" id="products" multiple>
						<option value="moln_report_basic_monthly" selected="selected">Moln Report Basic Monthly</option>
						<option value="moln_report_plus_monthly">Moln Report Plus Monthly</option>
						<option value="moln_report_basic_yearly">Moln Report Basic Yearly</option>
						<option value="moln_report_plus_yearly" selected="selected">Moln Report Plus Yearly</option>
					</select><br/>
				</div>
			</div>
		', $result);
	}
}