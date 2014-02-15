<?php
class nbk_SubTotalWithDiscount_Model_Freeshipping extends Mage_Shipping_Model_Carrier_Freeshipping
{
    /**
     * The original free shipping class will use the discounted package value.
     *
     * The package_value_with_discount value already is in the base currency
     * even if there is no "base" in the property name, no need to convert it.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $baseSubtotal = $request->getBaseSubtotalInclTax();
        $request->setBaseSubtotalInclTax($request->getPackageValueWithDiscount());
        $result = parent::collectRates($request);
        $request->setBaseSubtotalInclTax($baseSubtotal);
        return $result;
    }
}
