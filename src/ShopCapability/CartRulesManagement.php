<?php

namespace PrestaShop\ShopCapability;

class CartRulesManagement extends ShopCapability
{
	/**
	 * Create a Cart Rule
	 *
	 * $options may contain
	 * - name
	 * - discount: e.g. 10 %, 10 before tax, 10 after tax
	 */
	public function createCartRule(array $options)
	{
		$shop = $this->getShop();
		$browser = $this->getBrowser();

		$shop->getBackOfficeNavigator()->visit('AdminCartRules', 'new');

		$browser
		->fillIn($this->i18nFieldName('#name'), $options['name'])
		->click('#cart_rule_link_actions');

		$m = [];
		if (preg_match('/^\s*(\d+(?:.\d+)?)\s*((?:%|before|after))/', $options['discount'], $m))
		{
			$amount = $m[1];
			$type = $m[2];

			if ($type === '%')
			{
				$browser
				->clickLabelFor('apply_discount_percent')
				->waitFor('#reduction_percent')
				->fillIn('#reduction_percent', $amount);
			}
			else
			{
				$browser
				->clickLabelFor('apply_discount_amount')
				->waitFor('#reduction_amount')
				->fillIn('#reduction_amount', $amount)
				->select('select[name="reduction_tax"]', ['before' => 0, 'after' => 1][$type]);
			}
		}
		else
			throw new \Exception("Incorrect discount spec: {$options['discount']}.");

		$browser
		->click('#desc-cart_rule-save-and-stay')
		->ensureStandardSuccessMessageDisplayed();

		$id_cart_rule = (int)$browser->getURLParameter('id_cart_rule');

		if ($id_cart_rule <= 0)
			throw new \PrestaShop\Exception\CartRuleCreationIncorrectException();

		return $id_cart_rule;
	}
}